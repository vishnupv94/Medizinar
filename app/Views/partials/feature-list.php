<?php foreach ($features as $feat): ?>
    <div class="feature-item">
        <div class="feature-check">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:#a5781e">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <span class="text-gray-700 text-sm"><?= $feat ?></span>
    </div>
<?php endforeach; ?>