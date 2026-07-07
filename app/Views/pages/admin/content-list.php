<?php
$successMessages = [
    'created' => '✓ Content item created.',
    'updated' => '✓ Content item updated.',
    'deleted' => '✓ Content item deleted.',
];
$successKey = $_GET['success'] ?? '';
?>
<div class="space-y-6">

    <!-- Page header with explanation -->
    <div>
        <p class="text-sm text-gray-500 leading-relaxed max-w-3xl">
            Manage the content blocks that appear across your website pages. Each group of content items 
            maps to a specific section on a specific page. Edit labels, values, icons, and ordering below.
        </p>
    </div>

    <?php if (isset($successMessages[$successKey])): ?>
        <div class="px-4 py-3 rounded-lg text-sm font-medium bg-green-50 border border-green-200 text-green-700">
            <?= $successMessages[$successKey] ?>
        </div>
    <?php endif; ?>

    <?php if ($group === '' && $q === ''): ?>
        <!-- ===== GROUPED OVERVIEW (default view) ===== -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            <?php foreach ($groupsMeta as $gk => $meta):
                // Count items for this group
                $groupItems = array_filter($items, function($it) use ($gk) { return $it->group_key === $gk; });
                $groupCount = \App\Models\SiteContent::countFiltered($gk);
                $draftCount = 0;
                foreach ($groupItems as $gi) {
                    if ($gi->status === 'draft') $draftCount++;
                }
            ?>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow overflow-hidden">
                    <!-- Group header -->
                    <div class="px-5 pt-5 pb-3">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="font-bold text-gray-800 text-base"><?= h($meta['label']) ?></h3>
                            <span class="text-xs px-2 py-0.5 rounded-full bg-blue-50 text-blue-600 font-medium whitespace-nowrap">
                                <?= h($meta['page']) ?> Page
                            </span>
                        </div>
                        <p class="text-xs text-gray-500 leading-relaxed"><?= h($meta['desc']) ?></p>
                    </div>

                    <!-- Stats row -->
                    <div class="px-5 py-2.5 bg-gray-50/50 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                        <span>
                            <strong class="text-gray-700"><?= $groupCount ?></strong> item<?= $groupCount !== 1 ? 's' : '' ?>
                            <?php if ($draftCount > 0): ?>
                                <span class="text-amber-600 ml-1">(<?= $draftCount ?> draft)</span>
                            <?php endif; ?>
                        </span>
                    </div>

                    <!-- Actions -->
                    <div class="px-5 py-3 border-t border-gray-100 flex items-center gap-2">
                        <a href="<?= url('/admin/content?group=' . urlencode($gk)) ?>"
                           class="flex-1 text-center px-3 py-1.5 text-xs font-medium text-primary border border-primary/20 rounded-lg hover:bg-primary/5 transition-colors">
                            View & Edit Items
                        </a>
                        <a href="<?= url('/admin/content/create?group=' . urlencode($gk)) ?>"
                           class="px-3 py-1.5 text-xs font-medium text-white bg-primary rounded-lg hover:bg-primary-700 transition-colors">
                            + Add
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Quick summary -->
        <div class="text-xs text-gray-400 pt-2">
            Total: <strong class="text-gray-500"><?= $total ?></strong> content items across <strong class="text-gray-500"><?= count($groupsMeta) ?></strong> groups
        </div>

    <?php else: ?>
        <!-- ===== FILTERED / SINGLE GROUP VIEW ===== -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <?php if ($group !== '' && isset($groupsMeta[$group])): ?>
                    <div class="flex items-center gap-3 mb-1">
                        <h3 class="text-lg font-bold text-gray-800"><?= h($groupsMeta[$group]['label']) ?></h3>
                        <span class="text-xs px-2 py-0.5 rounded-full bg-blue-50 text-blue-600 font-medium">
                            <?= h($groupsMeta[$group]['page']) ?> Page
                        </span>
                    </div>
                    <p class="text-xs text-gray-500 mb-1"><?= h($groupsMeta[$group]['desc']) ?></p>
                <?php endif; ?>
                <p class="text-sm text-gray-500">
                    <?= $total ?> item<?= $total === 1 ? '' : 's' ?>
                    <?= $group !== '' ? ' in <strong class="text-gray-700">' . h($groupLabels[$group] ?? $group) . '</strong>' : '' ?>
                    <?= $q !== '' ? ' matching <strong class="text-gray-700">' . h($q) . '</strong>' : '' ?>
                </p>
            </div>
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2">
                <form method="GET" action="<?= url('/admin/content') ?>" class="flex items-center gap-2 flex-wrap">
                    <select name="group" class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/30 outline-none">
                        <option value="">All groups</option>
                        <?php foreach ($groupLabels as $gk => $gLabel): ?>
                            <option value="<?= h($gk) ?>" <?= $group === $gk ? 'selected' : '' ?>><?= h($gLabel ?: $gk) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                        </svg>
                        <input type="text" name="q" value="<?= h($q) ?>" placeholder="Search…"
                            class="pl-9 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none w-44">
                    </div>
                    <button type="submit" class="px-3 py-2 bg-primary text-white text-sm rounded-lg hover:bg-primary-700 transition-colors">Filter</button>
                </form>
                <a href="<?= url('/admin/content') ?>" class="px-3 py-2 text-sm text-gray-500 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-center">
                    ← All Groups
                </a>
                <a href="<?= url('/admin/content/create' . ($group !== '' ? '?group=' . urlencode($group) : '')) ?>"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-primary text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition-colors">
                    <svg class="w-4 h-4" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    New Item
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <?php if (empty($items)): ?>
                <p class="px-6 py-12 text-sm text-gray-400 text-center">No content items found.</p>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <?php if ($group === ''): ?>
                                    <th class="px-5 py-3 w-32">Group</th>
                                <?php endif; ?>
                                <th class="px-5 py-3">Label</th>
                                <th class="px-5 py-3">Value / Subtitle</th>
                                <th class="px-5 py-3 w-20 text-center">Icon</th>
                                <th class="px-5 py-3 w-20 text-center">Order</th>
                                <th class="px-5 py-3 w-28">Status</th>
                                <th class="px-5 py-3 w-36 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php foreach ($items as $c): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <?php if ($group === ''): ?>
                                        <td class="px-5 py-3">
                                            <a href="<?= url('/admin/content?group=' . urlencode($c->group_key)) ?>"
                                               class="inline-block px-2 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 transition-colors">
                                                <?= h($groupLabels[$c->group_key] ?? $c->group_key) ?>
                                            </a>
                                        </td>
                                    <?php endif; ?>
                                    <td class="px-5 py-3 font-medium text-gray-800"><?= h($c->label) ?></td>
                                    <td class="px-5 py-3 text-gray-500 max-w-xs">
                                        <p class="truncate"><?= h(mb_strimwidth($c->value ?? '', 0, 70, '…')) ?></p>
                                    </td>
                                    <td class="px-5 py-3 text-center text-xs text-gray-400">
                                        <?= $c->icon_type ? ('<span class="px-1.5 py-0.5 rounded bg-gray-100">' . h($c->icon_type) . '</span>') : '—' ?>
                                    </td>
                                    <td class="px-5 py-3 text-center text-gray-500"><?= (int)$c->sort_order ?></td>
                                    <td class="px-5 py-3">
                                        <span class="inline-block px-2 py-0.5 rounded-full text-xs font-medium <?= $c->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' ?>">
                                            <?= ucfirst($c->status) ?>
                                        </span>
                                    </td>
                                    <td class="px-5 py-3 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="<?= url('/admin/content/' . $c->id . '/edit') ?>"
                                                class="text-xs px-2.5 py-1 rounded-lg border border-gray-200 text-gray-600 hover:border-primary hover:text-primary transition-colors">Edit</a>
                                            <form method="POST" action="<?= url('/admin/content/' . $c->id . '/delete') ?>"
                                                onsubmit="return confirm('Delete this content item?')">
                                                <?= csrf_field() ?>
                                                <button type="submit"
                                                    class="text-xs px-2.5 py-1 rounded-lg border border-red-200 text-red-500 hover:bg-red-50 transition-colors">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <?php if ($pages > 1): ?>
                    <div class="flex items-center justify-between px-5 py-3 border-t border-gray-100 text-sm text-gray-500">
                        <span>Page <?= $page ?> of <?= $pages ?></span>
                        <div class="flex gap-1">
                            <?php for ($p = 1; $p <= $pages; $p++): ?>
                                <a href="<?= url('/admin/content?page=' . $p . ($group !== '' ? '&group=' . urlencode($group) : '') . ($q !== '' ? '&q=' . urlencode($q) : '')) ?>"
                                    class="px-3 py-1 rounded-lg <?= $p === $page ? 'bg-primary text-white' : 'hover:bg-gray-100' ?>">
                                    <?= $p ?>
                                </a>
                            <?php endfor; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>

</div>
