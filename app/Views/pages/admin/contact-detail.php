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
$e = $entry;
?>

<div class="max-w-3xl space-y-6">

    <a href="<?= url('/admin/entries/contact') ?>" class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-primary transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Back to Contact Entries
    </a>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <h2 class="font-semibold text-gray-800">Contact #<?= $e->id ?></h2>
                <?php if ($e->is_read): ?>
                    <span class="text-xs px-2 py-0.5 rounded-full bg-gray-100 text-gray-500">Read</span>
                <?php else: ?>
                    <span class="text-xs px-2 py-0.5 rounded-full bg-red-100 text-red-600 font-medium">New</span>
                <?php endif; ?>
            </div>
            <form method="POST" action="<?= url('/admin/entries/contact/' . $e->id . '/delete') ?>" data-confirm="Are you sure you want to delete this entry?">
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
                    <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Category</p>
                    <p class="text-sm text-gray-800"><?= h($categoryLabels[$e->category] ?? $e->category) ?></p>
                </div>
            </div>

            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Subject</p>
                <p class="text-sm font-medium text-gray-800"><?= h($e->subject) ?></p>
            </div>

            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Message</p>
                <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-wrap bg-gray-50 rounded-lg p-4"><?= h($e->message) ?></p>
            </div>

            <?php if ($e->attachment_name): ?>
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wider mb-2">Attachment</p>
                    <?php
                        $safePath = $e->attachment_path ?? null;
                        $fileUrl  = $safePath ? url('/uploads/contact/' . rawurlencode($safePath)) : null;
                        $ext      = $safePath ? strtolower(pathinfo($safePath, PATHINFO_EXTENSION)) : '';
                        $isImage  = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                    ?>
                    <?php if ($fileUrl): ?>
                        <?php if ($isImage): ?>
                            <a href="<?= h($fileUrl) ?>" target="_blank" rel="noopener" class="block mb-2">
                                <img src="<?= h($fileUrl) ?>" alt="<?= h($e->attachment_name) ?>"
                                    class="max-h-48 rounded-lg border border-gray-200 object-contain">
                            </a>
                        <?php endif; ?>
                        <a href="<?= h($fileUrl) ?>" download="<?= h($e->attachment_name) ?>"
                            class="inline-flex items-center gap-2 text-sm text-primary hover:text-primary-700 font-medium border border-primary/30 hover:border-primary/60 bg-primary-50 hover:bg-primary-100 px-3 py-1.5 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            <?= h($e->attachment_name) ?>
                        </a>
                    <?php else: ?>
                        <p class="text-sm text-gray-500 italic"><?= h($e->attachment_name) ?> <span class="text-gray-400">(file no longer available)</span></p>
                    <?php endif; ?>
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
</div>