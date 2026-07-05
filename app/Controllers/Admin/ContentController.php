<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\SiteContent;

class ContentController extends Controller
{
    private const PER_PAGE = 30;

    private const KNOWN_GROUPS = [
        'why_us'       => 'Why Choose Us',
        'stats'        => 'Stats / Counters',
        'trust_bullets'=> 'Trust Bullets',
        'core_values'  => 'Core Values',
        'why_reasons'  => 'Why Reasons',
        'commitments'  => 'Team Commitments',
    ];

    public function index(): void
    {
        $group  = trim($_GET['group'] ?? '');
        $q      = trim($_GET['q']     ?? '');
        $page   = max(1, (int) ($_GET['page'] ?? 1));
        $offset = ($page - 1) * self::PER_PAGE;

        $items  = SiteContent::getFiltered($group, $q, self::PER_PAGE, $offset);
        $total  = SiteContent::countFiltered($group, $q);
        $pages  = max(1, (int) ceil($total / self::PER_PAGE));
        $groups = array_merge(self::KNOWN_GROUPS, array_fill_keys(SiteContent::getGroups(), ''));

        $this->view('admin/content-list', compact('items', 'q', 'group', 'page', 'pages', 'total', 'groups') + ['pageTitle' => 'Site Content']);
    }

    public function create(): void
    {
        $this->view('admin/content-form', [
            'item'   => null,
            'errors' => [],
            'old'    => ['group_key' => $_GET['group'] ?? '', 'icon_type' => ''],
            'groups' => self::KNOWN_GROUPS,
            'pageTitle' => 'New Content Item',
        ]);
    }

    public function store(): void
    {
        $data   = $this->sanitize($_POST);
        $errors = $this->validate($data);

        if ($errors) {
            $this->view('admin/content-form', [
                'item' => null, 'errors' => $errors, 'old' => $data, 'groups' => self::KNOWN_GROUPS, 'pageTitle' => 'New Content Item',
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
            'groups' => self::KNOWN_GROUPS,
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
                'item' => $item, 'errors' => $errors, 'old' => $data, 'groups' => self::KNOWN_GROUPS, 'pageTitle' => 'Edit Content Item',
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
