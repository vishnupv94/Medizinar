<div class="space-y-4">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <p class="text-sm text-gray-500"><?= $total ?> item<?= $total === 1 ? '' : 's' ?><?= $group !== '' ? ' in group <strong class="text-gray-700">' . h($group) . '</strong>' : '' ?><?= $q !== '' ? ' matching <strong class="text-gray-700">' . h($q) . '</strong>' : '' ?></p>
        </div>
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2">
            <form method="GET" action="<?= url('/admin/content') ?>" class="flex items-center gap-2 flex-wrap">
                <select name="group" class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/30 outline-none">
                    <option value="">All groups</option>
                    <?php foreach ($groups as $gk => $gLabel): ?>
                        <option value="<?= h($gk) ?>" <?= $group === $gk ? 'selected' : '' ?>><?= h($gLabel ?: $gk) ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                    </svg>
                    <input type="text" name="q" value="<?= h($q) ?>" placeholder="Search…"
                        class="pl-9 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none w-44">
                </div>
                <button type="submit" class="px-3 py-2 bg-primary text-white text-sm rounded-lg hover:bg-primary-700 transition-colors">Filter</button>
                <?php if ($q !== '' || $group !== ''): ?>
                    <a href="<?= url('/admin/content') ?>" class="px-3 py-2 text-sm text-gray-500 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Clear</a>
                <?php endif; ?>
            </form>
            <a href="<?= url('/admin/content/create' . ($group !== '' ? '?group=' . urlencode($group) : '')) ?>"
                class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-primary text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                New Item
            </a>
        </div>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="px-4 py-3 rounded-lg text-sm font-medium bg-green-50 border border-green-200 text-green-700">
            <?= match($_GET['success']) {
                'created' => '✓ Content item created.',
                'updated' => '✓ Content item updated.',
                'deleted' => '✓ Content item deleted.',
                default   => '✓ Done.',
            } ?>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <?php if (empty($items)): ?>
            <p class="px-6 py-12 text-sm text-gray-400 text-center">No content items found.</p>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <th class="px-5 py-3 w-32">Group</th>
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
                                <td class="px-5 py-3">
                                    <span class="inline-block px-2 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                        <?= h($c->group_key) ?>
                                    </span>
                                </td>
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
</div>
