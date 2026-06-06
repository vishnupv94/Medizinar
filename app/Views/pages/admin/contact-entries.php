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

    <div class="flex items-center justify-between">
        <p class="text-sm text-gray-500"><?= $total ?> total entries</p>
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
        <div class="flex items-center justify-center gap-2">
            <?php if ($page > 1): ?>
                <a href="<?= url('/admin/entries/contact?page=' . ($page - 1)) ?>"
                    class="px-3 py-1.5 rounded-lg text-sm border border-gray-300 hover:bg-gray-50 transition-colors">&laquo; Prev</a>
            <?php endif; ?>
            <span class="text-sm text-gray-500">Page <?= $page ?> of <?= $totalPages ?></span>
            <?php if ($page < $totalPages): ?>
                <a href="<?= url('/admin/entries/contact?page=' . ($page + 1)) ?>"
                    class="px-3 py-1.5 rounded-lg text-sm border border-gray-300 hover:bg-gray-50 transition-colors">Next &raquo;</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

</div>