<?php
$categoryLabels = [
    'appointment'  => 'Appointment Inquiry',
    'service-info' => 'Service Information',
    'billing'      => 'Billing & Payment',
    'feedback'     => 'Feedback / Review',
    'complaint'    => 'Complaint / Issue',
    'caregiver'    => 'Caregiver Related',
    'general'      => 'General Query',
    'emergency'    => 'Urgent / Emergency',
];
?>

<div class="space-y-4">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <p class="text-sm text-gray-500"><?= $total ?> total entr<?= $total === 1 ? 'y' : 'ies' ?><?= $q !== '' ? ' matching <strong class="text-gray-700">' . h($q) . '</strong>' : '' ?></p>

        <form method="GET" action="<?= url('/admin/entries/contact') ?>" class="flex items-center gap-2">
            <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                </svg>
                <input type="text" name="q" value="<?= h($q) ?>" placeholder="Search name, phone, subject…"
                    class="pl-9 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none w-64">
            </div>
            <button type="submit" class="px-3 py-2 bg-primary text-white text-sm rounded-lg hover:bg-primary-700 transition-colors">Search</button>
            <?php if ($q !== ''): ?>
                <a href="<?= url('/admin/entries/contact') ?>" class="px-3 py-2 text-sm text-gray-500 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Clear</a>
            <?php endif; ?>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <?php if (empty($entries)): ?>
            <p class="px-6 py-12 text-sm text-gray-400 text-center">No contact entries found.</p>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <th class="px-5 py-3">#</th>
                            <th class="px-5 py-3">Name</th>
                            <th class="px-5 py-3">Phone</th>
                            <th class="px-5 py-3">Category</th>
                            <th class="px-5 py-3">Subject</th>
                            <th class="px-5 py-3">Date</th>
                            <th class="px-5 py-3 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($entries as $entry): ?>
                            <tr class="hover:bg-gray-50 transition-colors <?= !$entry->is_read ? 'bg-blue-50/40' : '' ?>">
                                <td class="px-5 py-3 text-gray-400"><?= $entry->id ?></td>
                                <td class="px-5 py-3">
                                    <a href="<?= url('/admin/entries/contact/' . $entry->id) ?>"
                                        class="font-medium text-gray-800 hover:text-primary <?= !$entry->is_read ? 'font-bold' : '' ?>">
                                        <?= h($entry->name) ?>
                                    </a>
                                </td>
                                <td class="px-5 py-3 text-gray-600"><?= h($entry->phone) ?></td>
                                <td class="px-5 py-3 text-gray-600"><?= h($categoryLabels[$entry->category] ?? $entry->category) ?></td>
                                <td class="px-5 py-3 text-gray-600 max-w-[200px] truncate"><?= h($entry->subject) ?></td>
                                <td class="px-5 py-3 text-gray-500 whitespace-nowrap"><?= date('M j, Y', strtotime($entry->created_at)) ?></td>
                                <td class="px-5 py-3 text-center">
                                    <?php if (!$entry->is_read): ?>
                                        <span class="inline-flex items-center gap-1 text-xs font-medium text-red-600">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> New
                                        </span>
                                    <?php else: ?>
                                        <span class="text-xs text-gray-400">Read</span>
                                    <?php endif; ?>
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
                <a href="<?= url('/admin/entries/contact?page=' . ($page - 1) . $qs) ?>"
                    class="px-3 py-1.5 rounded-lg text-sm border border-gray-300 hover:bg-gray-50 transition-colors">&laquo; Prev</a>
            <?php endif; ?>
            <span class="text-sm text-gray-500">Page <?= $page ?> of <?= $totalPages ?></span>
            <?php if ($page < $totalPages): ?>
                <a href="<?= url('/admin/entries/contact?page=' . ($page + 1) . $qs) ?>"
                    class="px-3 py-1.5 rounded-lg text-sm border border-gray-300 hover:bg-gray-50 transition-colors">Next &raquo;</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

</div>