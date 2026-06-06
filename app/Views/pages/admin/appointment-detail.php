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
$durationLabels = [
    '1-day'     => '1 Day (Trial)',
    '1-week'    => '1 Week',
    '2-weeks'   => '2 Weeks',
    '1-month'   => '1 Month',
    '3-months'  => '3 Months',
    '6-months'  => '6 Months',
    'long-term' => 'Long-term (6+ months)',
    'ongoing'   => 'Ongoing / As needed',
];
$statusColors = [
    'pending'   => 'bg-amber-100 text-amber-700',
    'confirmed' => 'bg-blue-100 text-blue-700',
    'completed' => 'bg-green-100 text-green-700',
    'cancelled' => 'bg-red-100 text-red-700',
];
$statusFlow = ['pending', 'confirmed', 'completed', 'cancelled'];
$e = $entry;
$badge = $statusColors[$e->status] ?? 'bg-gray-100 text-gray-600';
?>

<div class="max-w-3xl space-y-6">

    <a href="<?= url('/admin/entries/appointments') ?>" class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-primary transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Back to Appointments
    </a>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <h2 class="font-semibold text-gray-800">Appointment #<?= $e->id ?></h2>
                <span class="text-xs px-2.5 py-0.5 rounded-full font-medium <?= $badge ?>"><?= ucfirst($e->status) ?></span>
            </div>
            <form method="POST" action="<?= url('/admin/entries/appointments/' . $e->id . '/delete') ?>" data-confirm="Are you sure you want to delete this appointment?">
                <?= csrf_field() ?>
                <button type="submit" class="text-sm text-red-500 hover:text-red-700 transition-colors">Delete</button>
            </form>
        </div>

        <div class="p-6 space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Name</p>
                    <p class="text-sm font-medium text-gray-800"><?= h($e->name) ?></p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Phone</p>
                    <p class="text-sm text-gray-800">
                        <a href="tel:<?= h($e->phone) ?>" class="hover:text-primary"><?= h($e->phone) ?></a>
                    </p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Email</p>
                    <p class="text-sm text-gray-800"><?= $e->email ? h($e->email) : '<span class="text-gray-400">Not provided</span>' ?></p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Service</p>
                    <p class="text-sm text-gray-800"><?= h($serviceLabels[$e->service] ?? $e->service) ?></p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Start Date</p>
                    <p class="text-sm text-gray-800"><?= date('M j, Y', strtotime($e->start_date)) ?></p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Duration</p>
                    <p class="text-sm text-gray-800"><?= h($durationLabels[$e->duration] ?? $e->duration) ?></p>
                </div>
            </div>

            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Location</p>
                <p class="text-sm text-gray-700"><?= h($e->location) ?></p>
            </div>

            <?php if ($e->message): ?>
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Message / Special Requirements</p>
                    <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-wrap bg-gray-50 rounded-lg p-4"><?= h($e->message) ?></p>
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 border-t border-gray-100">
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Submitted</p>
                    <p class="text-sm text-gray-600"><?= date('M j, Y \a\t g:i A', strtotime($e->created_at)) ?></p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">IP Address</p>
                    <p class="text-sm text-gray-600"><?= h($e->ip_address ?: 'Unknown') ?></p>
                </div>
            </div>
        </div>
    </div>

    <?php if ($e->status !== 'completed' && $e->status !== 'cancelled'): ?>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-sm font-semibold text-gray-800 mb-3">Update Status</h3>
            <div class="flex flex-wrap gap-2">
                <?php foreach ($statusFlow as $s): ?>
                    <?php if ($s === $e->status) continue; ?>
                    <form method="POST" action="<?= url('/admin/entries/appointments/' . $e->id . '/status') ?>" class="inline"
                        <?= $s === 'cancelled' ? 'data-confirm="Cancel this appointment?"' : '' ?>>
                        <?= csrf_field() ?>
                        <input type="hidden" name="status" value="<?= $s ?>">
                        <button type="submit"
                            class="px-4 py-1.5 rounded-lg text-sm font-medium border transition-colors
                                       <?= $s === 'cancelled' ? 'border-red-300 text-red-600 hover:bg-red-50' : 'border-gray-300 text-gray-700 hover:bg-gray-50' ?>">
                            Mark <?= ucfirst($s) ?>
                        </button>
                    </form>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>