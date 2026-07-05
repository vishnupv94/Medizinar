<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\SiteContent;

class ContentController extends Controller
{
    private const PER_PAGE = 30;

    public function __construct()
    {
        $this->layout = 'admin';
        $this->guardAdmin();
    }
    private const KNOWN_GROUPS = [
        'why_us'        => ['label' => 'Why Choose Us',       'page' => 'Home',          'desc' => '6 feature cards shown in the "Why Choose Medizinar Care" grid on the home page'],
        'stats'         => ['label' => 'Stats / Counters',    'page' => 'Home',          'desc' => 'Counter cards (e.g. 100+, 24/7) in the green "Trusted Team" section'],
        'trust_bullets'=> ['label' => 'Trust Bullets',       'page' => 'Home',          'desc' => 'Checkmark bullet points under "Trusted & Verified Caregivers"'],
        'core_values'   => ['label' => 'Core Values',         'page' => 'About',         'desc' => 'Value cards (Compassion, Trust, etc.) shown in the About page'],
        'why_reasons'   => ['label' => 'Why Reasons',         'page' => 'About',         'desc' => 'Reasons listed in the "Why Choose Us" section on About page'],
        'commitments'   => ['label' => 'Team Commitments',    'page' => 'Team',          'desc' => 'Commitment cards shown below the team members grid'],
    ];

    /** Helper: returns a flat key => label map for dropdowns */
    private static function groupLabels(): array
    {
        $labels = [];
        foreach (self::KNOWN_GROUPS as $key => $meta) {
            $labels[$key] = $meta['label'];
        }
        return $labels;
    }

    public function index(): void
    {
        $group  = trim($_GET['group'] ?? '');
        $q      = trim($_GET['q']     ?? '');
        $page   = max(1, (int) ($_GET['page'] ?? 1));
        $offset = ($page - 1) * self::PER_PAGE;

        $items  = SiteContent::getFiltered($group, $q, self::PER_PAGE, $offset);
        $total  = SiteContent::countFiltered($group, $q);
        $pages  = max(1, (int) ceil($total / self::PER_PAGE));
        $groupLabels = self::groupLabels();
        // Merge any DB groups not in KNOWN_GROUPS
        foreach (SiteContent::getGroups() as $gk) {
            if (!isset($groupLabels[$gk])) $groupLabels[$gk] = $gk;
        }
        $groupsMeta = self::KNOWN_GROUPS;

        $this->view('admin/content-list', compact('items', 'q', 'group', 'page', 'pages', 'total', 'groupLabels', 'groupsMeta') + ['pageTitle' => 'Site Content']);
    }

    public function create(): void
    {
        $this->view('admin/content-form', [
            'item'   => null,
            'errors' => [],
            'old'    => ['group_key' => $_GET['group'] ?? '', 'icon_type' => ''],
            'groups' => self::groupLabels(),
            'pageTitle' => 'New Content Item',
        ]);
    }

    public function store(): void
    {
        $data   = $this->sanitize($_POST);
        $errors = $this->validate($data);

        if ($errors) {
            $this->view('admin/content-form', [
                'item' => null, 'errors' => $errors, 'old' => $data, 'groups' => self::groupLabels(), 'pageTitle' => 'New Content Item',
            ]);
            return;
        }

        SiteContent::create($data);
        $this->redirect('/admin/content?success=created&group=' . urlencode($data['group_key']));
    }

    public function edit(int $id): void
    {
        $item = SiteContent::findById($id);
        if (!$item) {
            $this->redirect('/admin/content', ['error' => 'Content item not found.']);
            return;
        }
        $this->view('admin/content-form', [
            'item'   => $item,
            'errors' => [],
            'old'    => (array) $item,
            'groups' => self::groupLabels(),
            'pageTitle' => 'Edit Content Item',
        ]);
    }

    public function update(int $id): void
    {
        $item = SiteContent::findById($id);
        if (!$item) {
            $this->redirect('/admin/content', ['error' => 'Content item not found.']);
            return;
        }

        $data   = $this->sanitize($_POST);
        $errors = $this->validate($data);

        if ($errors) {
            $this->view('admin/content-form', [
                'item' => $item, 'errors' => $errors, 'old' => $data, 'groups' => self::groupLabels(), 'pageTitle' => 'Edit Content Item',
            ]);
            return;
        }

        SiteContent::update($id, $data);
        $this->redirect('/admin/content?success=updated&group=' . urlencode($data['group_key']));
    }

    public function delete(int $id): void
    {
        $item = SiteContent::findById($id);
        $group = $item ? $item->group_key : '';
        SiteContent::delete($id);
        $this->redirect('/admin/content?success=deleted&group=' . urlencode($group));
    }

    // ----------------------------------------------------------------
    private function sanitize(array $p): array
    {
        $iconType = in_array($p['icon_type'] ?? '', ['svg', 'path', 'url', 'emoji', ''])
            ? ($p['icon_type'] ?? '')
            : '';

        return [
            'group_key'  => trim($p['group_key']  ?? ''),
            'item_key'   => trim($p['item_key']   ?? '') ?: null,
            'label'      => trim($p['label']      ?? ''),
            'value'      => trim($p['value']      ?? '') ?: null,
            'icon_type'  => $iconType,
            'icon_value' => trim($p['icon_value'] ?? '') ?: null,
            'sort_order' => (int) ($p['sort_order'] ?? 0),
            'status'     => in_array($p['status'] ?? '', ['draft', 'published']) ? $p['status'] : 'published',
        ];
    }

    private function validate(array $d): array
    {
        $e = [];
        if ($d['group_key'] === '') $e['group_key'] = 'Group is required.';
        if ($d['label']     === '') $e['label']     = 'Label is required.';
        return $e;
    }
}
