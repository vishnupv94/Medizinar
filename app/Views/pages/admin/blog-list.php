<div class="space-y-4">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <p class="text-sm text-gray-500"><?= $total ?> total post<?= $total === 1 ? '' : 's' ?><?= $q !== '' ? ' matching <strong class="text-gray-700">' . h($q) . '</strong>' : '' ?></p>
        </div>
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2">
            <form method="GET" action="<?= url('/admin/blog') ?>" class="flex items-center gap-2">
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                    </svg>
                    <input type="text" name="q" value="<?= h($q) ?>" placeholder="Search posts…"
                        class="pl-9 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none w-56">
                </div>
                <button type="submit" class="px-3 py-2 bg-primary text-white text-sm rounded-lg hover:bg-primary-700 transition-colors">Search</button>
                <?php if ($q !== ''): ?>
                    <a href="<?= url('/admin/blog') ?>" class="px-3 py-2 text-sm text-gray-500 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Clear</a>
                <?php endif; ?>
            </form>
            <a href="<?= url('/admin/blog/create') ?>"
                class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-primary text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition-colors">
                <svg class="w-4 h-4" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                New Post
            </a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <?php if (empty($posts)): ?>
            <p class="px-6 py-12 text-sm text-gray-400 text-center">No blog posts found.</p>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <th class="px-5 py-3 w-16">Image</th>
                            <th class="px-5 py-3">Title</th>
                            <th class="px-5 py-3">Status</th>
                            <th class="px-5 py-3">Date</th>
                            <th class="px-5 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($posts as $post): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-5 py-3">
                                    <?php if ($post->image): ?>
                                        <img src="<?= url('uploads/blog/' . h($post->image)) ?>" alt="" class="w-12 h-9 object-cover rounded-md border border-gray-200">
                                    <?php else: ?>
                                        <div class="w-12 h-9 bg-gray-100 rounded-md flex items-center justify-center">
                                            <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td class="px-5 py-3">
                                    <a href="<?= url('/admin/blog/' . $post->id . '/edit') ?>"
                                        class="font-medium text-gray-800 hover:text-primary transition-colors">
                                        <?= h($post->title) ?>
                                    </a>
                                    <p class="text-xs text-gray-400 mt-0.5">/blog/<?= h($post->slug) ?></p>
                                </td>
                                <td class="px-5 py-3">
                                    <?php if ($post->status === 'published'): ?>
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
                                    <?= date('M j, Y', strtotime($post->updated_at)) ?>
                                </td>
                                <td class="px-5 py-3">
                                    <div class="flex items-center justify-center gap-1">
                                        <a href="<?= url('/admin/blog/' . $post->id . '/preview') ?>" title="Preview"
                                            class="p-1.5 rounded-md text-gray-400 hover:text-primary hover:bg-primary-50 transition-colors">
                                            <svg class="w-4 h-4" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </a>
                                        <a href="<?= url('/admin/blog/' . $post->id . '/edit') ?>" title="Edit"
                                            class="p-1.5 rounded-md text-gray-400 hover:text-primary hover:bg-primary-50 transition-colors">
                                            <svg class="w-4 h-4" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="<?= url('/admin/blog/' . $post->id . '/delete') ?>" method="POST"
                                            data-confirm="Are you sure you want to delete this post?" class="inline">
                                            <?= csrf_field() ?>
                                            <button type="submit" title="Delete"
                                                class="p-1.5 rounded-md text-gray-400 hover:text-red-600 hover:bg-red-50 transition-colors">
                                                <svg class="w-4 h-4" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                <a href="<?= url('/admin/blog?page=' . ($page - 1) . $qs) ?>"
                    class="px-3 py-1.5 rounded-lg text-sm border border-gray-300 hover:bg-gray-50 transition-colors">&laquo; Prev</a>
            <?php endif; ?>
            <span class="text-sm text-gray-500">Page <?= $page ?> of <?= $totalPages ?></span>
            <?php if ($page < $totalPages): ?>
                <a href="<?= url('/admin/blog?page=' . ($page + 1) . $qs) ?>"
                    class="px-3 py-1.5 rounded-lg text-sm border border-gray-300 hover:bg-gray-50 transition-colors">Next &raquo;</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

</div>
