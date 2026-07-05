<div class="space-y-4">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <p class="text-sm text-gray-500"><?= $total ?> service<?= $total === 1 ? '' : 's' ?><?= $q !== '' ? ' matching <strong class="text-gray-700">' . h($q) . '</strong>' : '' ?></p>
        </div>
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2">
            <form method="GET" action="<?= url('/admin/services') ?>" class="flex items-center gap-2">
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                    </svg>
                    <input type="text" name="q" value="<?= h($q) ?>" placeholder="Search services…"
                        class="pl-9 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none w-56">
                </div>
                <button type="submit" class="px-3 py-2 bg-primary text-white text-sm rounded-lg hover:bg-primary-700 transition-colors">Search</button>
                <?php if ($q !== ''): ?>
                    <a href="<?= url('/admin/services') ?>" class="px-3 py-2 text-sm text-gray-500 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Clear</a>
                <?php endif; ?>
            </form>
            <a href="<?= url('/admin/services/create') ?>"
                class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-primary text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                New Service
            </a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <?php if (empty($services)): ?>
            <p class="px-6 py-12 text-sm text-gray-400 text-center">No services found.</p>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <th class="px-5 py-3">Service</th>
                            <th class="px-5 py-3 w-28">Colour</th>
                            <th class="px-5 py-3 w-20 text-center">Order</th>
                            <th class="px-5 py-3 w-32">Status</th>
                            <th class="px-5 py-3 w-40">Updated</th>
                            <th class="px-5 py-3 w-36 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($services as $svc): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-5 py-3">
                                    <a href="<?= url('/admin/services/' . $svc->id . '/edit') ?>"
                                        class="font-medium text-gray-800 hover:text-primary transition-colors block">
                                        <?= h($svc->h1) ?>
                                    </a>
                                    <p class="text-xs text-gray-400 mt-0.5">/services/<?= h($svc->slug) ?></p>
                                </td>
                                <td class="px-5 py-3">
                                    <span class="inline-flex items-center gap-1.5 text-xs font-medium px-2 py-1 rounded-full"
                                        style="<?= $svc->color === 'green' ? 'background:#e0f4e2;color:#186c21' : 'background:#fef4d8;color:#a5781e' ?>">
                                        <span class="w-2 h-2 rounded-full" style="background:<?= $svc->color === 'green' ? '#186c21' : '#a5781e' ?>"></span>
                                        <?= ucfirst($svc->color) ?>
                                    </span>
                                </td>
                                <td class="px-5 py-3 text-center text-gray-700"><?= (int) $svc->sort_order ?></td>
                                <td class="px-5 py-3">
                                    <?php if ($svc->status === 'published'): ?>
                                        <span class="inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-full bg-green-100 text-green-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Published
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-full bg-amber-100 text-amber-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Draft
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-5 py-3 text-gray-500 whitespace-nowrap">
                                    <?= date('M j, Y', strtotime($svc->updated_at)) ?>
                                </td>
                                <td class="px-5 py-3">
                                    <div class="flex items-center justify-center gap-1">
                                        <a href="<?= url('/services/' . $svc->slug) ?>" target="_blank" title="View live page"
                                            class="p-1.5 rounded-md text-gray-400 hover:text-primary hover:bg-primary-50 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                            </svg>
                                        </a>
                                        <a href="<?= url('/admin/services/' . $svc->id . '/edit') ?>" title="Edit"
                                            class="p-1.5 rounded-md text-gray-400 hover:text-primary hover:bg-primary-50 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="<?= url('/admin/services/' . $svc->id . '/delete') ?>" method="POST"
                                            data-confirm="Delete '<?= h($svc->h1) ?>'? This cannot be undone." class="inline">
                                            <?= csrf_field() ?>
                                            <button type="submit" title="Delete"
                                                class="p-1.5 rounded-md text-gray-400 hover:text-red-600 hover:bg-red-50 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <?php if ($totalPages > 1): ?>
        <?php $qs = $q !== '' ? '&q=' . urlencode($q) : ''; ?>
        <div class="flex items-center justify-center gap-2">
            <?php if ($page > 1): ?>
                <a href="<?= url('/admin/services?page=' . ($page - 1) . $qs) ?>"
                    class="px-3 py-1.5 rounded-lg text-sm border border-gray-300 hover:bg-gray-50 transition-colors">&laquo; Prev</a>
            <?php endif; ?>
            <span class="text-sm text-gray-500">Page <?= $page ?> of <?= $totalPages ?></span>
            <?php if ($page < $totalPages): ?>
                <a href="<?= url('/admin/services?page=' . ($page + 1) . $qs) ?>"
                    class="px-3 py-1.5 rounded-lg text-sm border border-gray-300 hover:bg-gray-50 transition-colors">Next &raquo;</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

</div>
