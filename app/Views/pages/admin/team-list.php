<div class="space-y-4">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <p class="text-sm text-gray-500"><?= $total ?> team member<?= $total === 1 ? '' : 's' ?><?= $q !== '' ? ' matching <strong class="text-gray-700">' . h($q) . '</strong>' : '' ?></p>
        </div>
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2">
            <form method="GET" action="<?= url('/admin/team') ?>" class="flex items-center gap-2">
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                    </svg>
                    <input type="text" name="q" value="<?= h($q) ?>" placeholder="Search team…"
                        class="pl-9 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none w-52">
                </div>
                <button type="submit" class="px-3 py-2 bg-primary text-white text-sm rounded-lg hover:bg-primary-700 transition-colors">Search</button>
                <?php if ($q !== ''): ?>
                    <a href="<?= url('/admin/team') ?>" class="px-3 py-2 text-sm text-gray-500 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Clear</a>
                <?php endif; ?>
            </form>
            <a href="<?= url('/admin/team/create') ?>"
                class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-primary text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                New Member
            </a>
        </div>
    </div>

    <?php if (isset($_GET['success'])):
        $msgs = ['created' => '✓ Team member created.', 'updated' => '✓ Team member updated.', 'deleted' => '✓ Team member deleted.'];
    ?>
        <div class="px-4 py-3 rounded-lg text-sm font-medium bg-green-50 border border-green-200 text-green-700">
            <?= $msgs[$_GET['success']] ?? '✓ Done.' ?>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <?php if (empty($items)): ?>
            <p class="px-6 py-12 text-sm text-gray-400 text-center">No team members found.</p>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <th class="px-5 py-3 w-12">Photo</th>
                            <th class="px-5 py-3">Name / Role</th>
                            <th class="px-5 py-3 w-20 text-center">Order</th>
                            <th class="px-5 py-3 w-28">Status</th>
                            <th class="px-5 py-3 w-36 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($items as $m): ?>
                            <?php
                            $photoUrl = $m->photo
                                ? (str_starts_with($m->photo, 'http')
                                    ? $m->photo
                                    : (str_starts_with($m->photo, 'uploads/')
                                        ? url($m->photo)
                                        : asset($m->photo)))
                                : '';
                            ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-5 py-3">
                                    <?php if ($photoUrl): ?>
                                        <img src="<?= h($photoUrl) ?>" alt="<?= h($m->name) ?>"
                                            class="w-10 h-10 rounded-full object-cover border border-gray-200">
                                    <?php else: ?>
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-white text-sm font-bold"
                                            style="background:<?= h($m->color ?? '#176B23') ?>">
                                            <?= h($m->initial ?? strtoupper(substr($m->name, 0, 1))) ?>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td class="px-5 py-3">
                                    <p class="font-medium text-gray-800"><?= h($m->name) ?></p>
                                    <p class="text-xs text-gray-400 mt-0.5"><?= h($m->role) ?></p>
                                </td>
                                <td class="px-5 py-3 text-center text-gray-500"><?= (int)$m->sort_order ?></td>
                                <td class="px-5 py-3">
                                    <span class="inline-block px-2 py-0.5 rounded-full text-xs font-medium <?= $m->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' ?>">
                                        <?= ucfirst($m->status) ?>
                                    </span>
                                </td>
                                <td class="px-5 py-3 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="<?= url('/admin/team/' . $m->id . '/edit') ?>"
                                            class="text-xs px-2.5 py-1 rounded-lg border border-gray-200 text-gray-600 hover:border-primary hover:text-primary transition-colors">Edit</a>
                                        <form method="POST" action="<?= url('/admin/team/' . $m->id . '/delete') ?>"
                                            onsubmit="return confirm('Delete <?= h($m->name) ?>?')">
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
                            <a href="<?= url('/admin/team?page=' . $p . ($q !== '' ? '&q=' . urlencode($q) : '')) ?>"
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
