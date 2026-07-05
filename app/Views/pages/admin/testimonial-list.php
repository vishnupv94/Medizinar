<div class="space-y-4">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <p class="text-sm text-gray-500"><?= $total ?> testimonial<?= $total === 1 ? '' : 's' ?><?= $q !== '' ? ' matching <strong class="text-gray-700">' . h($q) . '</strong>' : '' ?></p>
        </div>
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2">
            <form method="GET" action="<?= url('/admin/testimonials') ?>" class="flex items-center gap-2">
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                    </svg>
                    <input type="text" name="q" value="<?= h($q) ?>" placeholder="Search testimonials…"
                        class="pl-9 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none w-52">
                </div>
                <button type="submit" class="px-3 py-2 bg-primary text-white text-sm rounded-lg hover:bg-primary-700 transition-colors">Search</button>
                <?php if ($q !== ''): ?>
                    <a href="<?= url('/admin/testimonials') ?>" class="px-3 py-2 text-sm text-gray-500 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Clear</a>
                <?php endif; ?>
            </form>
            <a href="<?= url('/admin/testimonials/create') ?>"
                class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-primary text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                New Testimonial
            </a>
        </div>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="px-4 py-3 rounded-lg text-sm font-medium bg-green-50 border border-green-200 text-green-700">
            <?= match($_GET['success']) {
                'created' => '✓ Testimonial created.',
                'updated' => '✓ Testimonial updated.',
                'deleted' => '✓ Testimonial deleted.',
                default   => '✓ Done.',
            } ?>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <?php if (empty($items)): ?>
            <p class="px-6 py-12 text-sm text-gray-400 text-center">No testimonials found.</p>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <th class="px-5 py-3">Name / Location</th>
                            <th class="px-5 py-3">Review</th>
                            <th class="px-5 py-3 w-20 text-center">Stars</th>
                            <th class="px-5 py-3 w-20 text-center">Order</th>
                            <th class="px-5 py-3 w-28">Status</th>
                            <th class="px-5 py-3 w-36 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($items as $t): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-5 py-3">
                                    <p class="font-medium text-gray-800"><?= h($t->name) ?></p>
                                    <?php if ($t->location_label): ?>
                                        <p class="text-xs text-gray-400 mt-0.5"><?= h($t->location_label) ?></p>
                                    <?php endif; ?>
                                </td>
                                <td class="px-5 py-3 max-w-xs">
                                    <p class="text-gray-600 truncate"><?= h(mb_strimwidth($t->text, 0, 90, '…')) ?></p>
                                </td>
                                <td class="px-5 py-3 text-center">
                                    <span class="text-yellow-500 font-semibold"><?= str_repeat('★', (int)$t->stars) ?></span>
                                </td>
                                <td class="px-5 py-3 text-center text-gray-500"><?= (int)$t->sort_order ?></td>
                                <td class="px-5 py-3">
                                    <span class="inline-block px-2 py-0.5 rounded-full text-xs font-medium <?= $t->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' ?>">
                                        <?= ucfirst($t->status) ?>
                                    </span>
                                </td>
                                <td class="px-5 py-3 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="<?= url('/admin/testimonials/' . $t->id . '/edit') ?>"
                                            class="text-xs px-2.5 py-1 rounded-lg border border-gray-200 text-gray-600 hover:border-primary hover:text-primary transition-colors">Edit</a>
                                        <form method="POST" action="<?= url('/admin/testimonials/' . $t->id . '/delete') ?>"
                                            onsubmit="return confirm('Delete this testimonial?')">
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
                            <a href="<?= url('/admin/testimonials?page=' . $p . ($q !== '' ? '&q=' . urlencode($q) : '')) ?>"
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
