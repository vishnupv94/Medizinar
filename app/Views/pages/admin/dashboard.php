<div class="space-y-6">

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Contacts</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1"><?= $totalContacts ?></p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Unread Contacts</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1"><?= $unreadContacts ?></p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-red-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Appointments</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1"><?= $totalAppointments ?></p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-green-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Pending Appointments</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1"><?= $pendingAppointments ?></p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h2 class="font-semibold text-gray-800">Recent Contact Entries</h2>
                <a href="<?= url('/admin/entries/contact') ?>" class="text-sm text-primary hover:underline">View all</a>
            </div>
            <?php if (empty($recentContacts)): ?>
                <p class="px-5 py-8 text-sm text-gray-400 text-center">No contact entries yet.</p>
            <?php else: ?>
                <div class="divide-y divide-gray-50">
                    <?php foreach ($recentContacts as $c): ?>
                        <a href="<?= url('/admin/entries/contact/' . $c->id) ?>"
                            class="flex items-center justify-between px-5 py-3 hover:bg-gray-50 transition-colors">
                            <div class="min-w-0">
                                <p class="text-sm font-medium text-gray-800 truncate <?= !$c->is_read ? 'font-bold' : '' ?>"><?= h($c->name) ?></p>
                                <p class="text-xs text-gray-500 truncate"><?= h($c->subject) ?></p>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0 ml-3">
                                <?php if (!$c->is_read): ?>
                                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                <?php endif; ?>
                                <span class="text-xs text-gray-400"><?= date('M j', strtotime($c->created_at)) ?></span>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h2 class="font-semibold text-gray-800">Recent Appointments</h2>
                <a href="<?= url('/admin/entries/appointments') ?>" class="text-sm text-primary hover:underline">View all</a>
            </div>
            <?php if (empty($recentAppointments)): ?>
                <p class="px-5 py-8 text-sm text-gray-400 text-center">No appointments yet.</p>
            <?php else: ?>
                <div class="divide-y divide-gray-50">
                    <?php foreach ($recentAppointments as $a): ?>
                        <?php
                        $statusColors = ['pending' => 'bg-amber-100 text-amber-700', 'confirmed' => 'bg-blue-100 text-blue-700', 'completed' => 'bg-green-100 text-green-700', 'cancelled' => 'bg-red-100 text-red-700'];
                        $badge = $statusColors[$a->status] ?? 'bg-gray-100 text-gray-600';
                        ?>
                        <a href="<?= url('/admin/entries/appointments/' . $a->id) ?>"
                            class="flex items-center justify-between px-5 py-3 hover:bg-gray-50 transition-colors">
                            <div class="min-w-0">
                                <p class="text-sm font-medium text-gray-800 truncate <?= !$a->is_read ? 'font-bold' : '' ?>"><?= h($a->name) ?></p>
                                <p class="text-xs text-gray-500 truncate"><?= h($a->service) ?> &middot; <?= date('M j', strtotime($a->start_date)) ?></p>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0 ml-3">
                                <span class="text-xs px-2 py-0.5 rounded-full font-medium <?= $badge ?>"><?= ucfirst($a->status) ?></span>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>