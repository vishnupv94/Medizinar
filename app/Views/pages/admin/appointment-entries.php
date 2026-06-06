<?php
$serviceLabels = [
    'bedside'            => 'Bedside Patient Care',
    'elderly'            => 'Elderly Care',
    'mother-baby'        => 'Mother & Baby Care',
    'housemaid'          => 'House Maid Services',
    'hospital-companion' => 'Hospital Visit Companion',
    'day-support'        => 'Elderly Day Support',
    'night-care'         => 'Night Care Service',
    'nri'                => 'NRI Parent Care Check',
];
$statusColors = [
    'pending'   => 'bg-amber-100 text-amber-700',
    'confirmed' => 'bg-blue-100 text-blue-700',
    'completed' => 'bg-green-100 text-green-700',
    'cancelled' => 'bg-red-100 text-red-700',
];
?>

<div class="space-y-4">

    <div class="flex items-center justify-between">
        <p class="text-sm text-gray-500"><?= $total ?> total entries</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <?php if (empty($entries)): ?>
            <p class="px-6 py-12 text-sm text-gray-400 text-center">No appointment entries found.</p>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <th class="px-5 py-3">#</th>
                            <th class="px-5 py-3">Name</th>
                            <th class="px-5 py-3">Phone</th>
                            <th class="px-5 py-3">Service</th>
                            <th class="px-5 py-3">Start Date</th>
                            <th class="px-5 py-3">Status</th>
                            <th class="px-5 py-3">Submitted</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($entries as $entry): ?>
                            <?php $badge = $statusColors[$entry->status] ?? 'bg-gray-100 text-gray-600'; ?>
                            <tr class="hover:bg-gray-50 transition-colors <?= !$entry->is_read ? 'bg-blue-50/40' : '' ?>">
                                <td class="px-5 py-3 text-gray-400"><?= $entry->id ?></td>
                                <td class="px-5 py-3">
                                    <a href="<?= url('/admin/entries/appointments/' . $entry->id) ?>"
                                        class="font-medium text-gray-800 hover:text-primary <?= !$entry->is_read ? 'font-bold' : '' ?>">
                                        <?= h($entry->name) ?>
                                    </a>
                                </td>
                                <td class="px-5 py-3 text-gray-600"><?= h($entry->phone) ?></td>
                                <td class="px-5 py-3 text-gray-600"><?= h($serviceLabels[$entry->service] ?? $entry->service) ?></td>
                                <td class="px-5 py-3 text-gray-600 whitespace-nowrap"><?= date('M j, Y', strtotime($entry->start_date)) ?></td>
                                <td class="px-5 py-3">
                                    <span class="text-xs px-2 py-0.5 rounded-full font-medium <?= $badge ?>"><?= ucfirst($entry->status) ?></span>
                                </td>
                                <td class="px-5 py-3 text-gray-500 whitespace-nowrap"><?= date('M j, Y', strtotime($entry->created_at)) ?></td>
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
                <a href="<?= url('/admin/entries/appointments?page=' . ($page - 1)) ?>"
                    class="px-3 py-1.5 rounded-lg text-sm border border-gray-300 hover:bg-gray-50 transition-colors">&laquo; Prev</a>
            <?php endif; ?>
            <span class="text-sm text-gray-500">Page <?= $page ?> of <?= $totalPages ?></span>
            <?php if ($page < $totalPages): ?>
                <a href="<?= url('/admin/entries/appointments?page=' . ($page + 1)) ?>"
                    class="px-3 py-1.5 rounded-lg text-sm border border-gray-300 hover:bg-gray-50 transition-colors">Next &raquo;</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

</div>