<?php $isEdit = $member !== null; ?>
<div class="max-w-4xl">

    <div class="flex items-center gap-3 mb-6">
        <a href="<?= url('/admin/team') ?>" class="text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <h2 class="text-lg font-semibold text-gray-800"><?= $isEdit ? 'Edit Team Member' : 'New Team Member' ?></h2>
    </div>

    <?php if ($errors): ?>
        <div class="mb-5 px-4 py-3 rounded-lg bg-red-50 border border-red-200 text-sm text-red-700 space-y-1">
            <?php foreach ($errors as $e): ?><p>• <?= h($e) ?></p><?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data"
        action="<?= $isEdit ? url('/admin/team/' . $member->id . '/update') : url('/admin/team') ?>"
        class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-5">
        <?= csrf_field() ?>

        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="<?= h($old['name'] ?? '') ?>" required
                    class="w-full px-3 py-2 text-sm border <?= isset($errors['name']) ? 'border-red-400' : 'border-gray-300' ?> rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Role <span class="text-red-500">*</span></label>
                <input type="text" name="role" value="<?= h($old['role'] ?? '') ?>" required
                    class="w-full px-3 py-2 text-sm border <?= isset($errors['role']) ? 'border-red-400' : 'border-gray-300' ?> rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
            <textarea name="bio" rows="3"
                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none resize-y"><?= h($old['bio'] ?? '') ?></textarea>
        </div>

        <!-- Photo Upload -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Photo</label>
            <?php
            $existingPhoto = $old['photo'] ?? ($member->photo ?? '');
            $photoUrl = $existingPhoto
                ? (str_starts_with($existingPhoto, 'http')
                    ? $existingPhoto
                    : (str_starts_with($existingPhoto, 'uploads/')
                        ? url($existingPhoto)
                        : asset($existingPhoto)))
                : '';
            ?>
            <input type="file" name="photo" accept="image/jpeg,image/png,image/webp,image/gif" id="photoFileInput"
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary/10 file:text-primary hover:file:bg-primary/20 cursor-pointer">
            <p class="text-xs text-gray-400 mt-1">JPEG, PNG, WebP, GIF · max 3 MB. Leave blank to keep current photo.</p>
            <?php if (isset($errors['photo'])): ?><p class="text-xs text-red-500 mt-1"><?= h($errors['photo']) ?></p><?php endif; ?>
            <!-- Fallback: manual path -->
            <div class="mt-3">
                <label class="block text-xs text-gray-400 mb-1">Or enter existing path (e.g. images/team/file.webp)</label>
                <input type="text" name="photo_path" id="photoPathInput" value="<?= h($existingPhoto) ?>" placeholder="images/team/…"
                    class="w-full px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none">
            </div>
        </div>

        <!-- ===== Photo Position Editor ===== -->
        <div id="posEditorPanel" style="display:<?= $photoUrl ? 'block' : 'none' ?>">
            <label class="block text-sm font-medium text-gray-700 mb-3">
                Photo Crop Position
                <span class="text-xs font-normal text-gray-400 ml-1">— adjust how the photo is framed in the card</span>
            </label>

            <div class="flex flex-col lg:flex-row gap-5">
                <!-- Live Preview Card -->
                <div class="flex-shrink-0">
                    <div id="posPreviewCard" style="width:180px; aspect-ratio:3/4; border-radius:12px; overflow:hidden; border:1px solid #e5e7eb; box-shadow:0 2px 10px rgba(0,0,0,0.08); position:relative; background:#f3f4f6;">
                        <img id="posPreviewImg" src="<?= h($photoUrl) ?>" alt="Preview"
                             style="width:100%; height:100%; object-fit:cover; object-position:<?= h($old['obj_pos'] ?? 'center 20%') ?>; display:block;">
                        <!-- Nameplate overlay -->
                        <div style="position:absolute; bottom:0; left:0; right:0; padding:10px 12px;
                                    background:linear-gradient(to top, rgba(0,0,0,0.6) 0%, transparent 100%);">
                            <div style="color:#fff; font-size:11px; font-weight:700; line-height:1.2;"><?= h($old['name'] ?? 'Member Name') ?></div>
                            <span style="display:inline-block; font-size:9px; font-weight:600; padding:2px 7px; border-radius:999px;
                                         color:#fff; background:<?= h($old['color'] ?? '#176B23') ?>88; margin-top:3px;">
                                <?= h($old['role'] ?? 'Role') ?>
                            </span>
                        </div>
                    </div>
                    <p class="text-[10px] text-gray-400 text-center mt-1.5">Live Preview</p>
                </div>

                <!-- Controls -->
                <div class="flex-1 space-y-4">
                    <!-- Preset Buttons -->
                    <div>
                        <span class="text-xs font-medium text-gray-500 mb-2 block">Quick Presets</span>
                        <div class="flex flex-wrap gap-1.5">
                            <?php
                            $presets = [
                                ['label' => 'Face Top',     'value' => 'center 15%'],
                                ['label' => 'Face Upper',   'value' => 'center 25%'],
                                ['label' => 'Center',       'value' => 'center center'],
                                ['label' => 'Top Left',     'value' => 'left top'],
                                ['label' => 'Top Right',    'value' => 'right top'],
                                ['label' => 'Bottom',       'value' => 'center bottom'],
                            ];
                            foreach ($presets as $p):
                            ?>
                                <button type="button" onclick="applyPreset('<?= $p['value'] ?>')"
                                    class="pos-preset-btn px-2.5 py-1 text-[11px] font-medium rounded-md border transition-all
                                           border-gray-200 bg-white text-gray-600 hover:border-primary hover:text-primary hover:bg-primary/5"
                                    data-val="<?= $p['value'] ?>">
                                    <?= $p['label'] ?>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Range Sliders -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="flex items-center justify-between text-xs font-medium text-gray-600 mb-1">
                                <span>Horizontal (X)</span>
                                <span id="posXLabel" class="tabular-nums text-primary font-semibold">50%</span>
                            </label>
                            <input type="range" id="posXSlider" min="0" max="100" value="50" step="1"
                                class="pos-range-slider w-full">
                            <div class="flex justify-between text-[10px] text-gray-400 mt-0.5">
                                <span>Left</span><span>Center</span><span>Right</span>
                            </div>
                        </div>
                        <div>
                            <label class="flex items-center justify-between text-xs font-medium text-gray-600 mb-1">
                                <span>Vertical (Y)</span>
                                <span id="posYLabel" class="tabular-nums text-primary font-semibold">20%</span>
                            </label>
                            <input type="range" id="posYSlider" min="0" max="100" value="20" step="1"
                                class="pos-range-slider w-full">
                            <div class="flex justify-between text-[10px] text-gray-400 mt-0.5">
                                <span>Top</span><span>Center</span><span>Bottom</span>
                            </div>
                        </div>
                    </div>

                    <!-- Final Value (readonly, synced) -->
                    <div>
                        <label class="text-xs font-medium text-gray-500 mb-1 block">CSS Value</label>
                        <div class="flex items-center gap-2">
                            <input type="text" name="obj_pos" id="objPosInput"
                                   value="<?= h($old['obj_pos'] ?? 'center 20%') ?>"
                                   class="flex-1 px-3 py-1.5 text-sm border border-gray-200 rounded-lg bg-gray-50 font-mono
                                          focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none">
                            <button type="button" onclick="syncSlidersFromInput()" title="Apply custom value"
                                class="px-3 py-1.5 text-xs font-medium rounded-lg border border-gray-200 bg-white text-gray-600
                                       hover:border-primary hover:text-primary transition-colors">
                                Apply
                            </button>
                        </div>
                        <p class="text-[10px] text-gray-400 mt-1">You can type any valid CSS object-position value, then click Apply.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- ===== / Photo Position Editor ===== -->

        <!-- Hidden obj_pos fallback for when no photo -->
        <input type="hidden" id="objPosHidden" name="obj_pos_fallback" value="<?= h($old['obj_pos'] ?? 'center 20%') ?>" disabled>

        <div class="grid sm:grid-cols-3 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Initial (avatar fallback)</label>
                <input type="text" name="initial" maxlength="2" value="<?= h($old['initial'] ?? '') ?>" placeholder="e.g. J"
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Accent Colour</label>
                <div class="flex items-center gap-2">
                    <input type="color" name="color" value="<?= h($old['color'] ?? '#176B23') ?>"
                        class="w-10 h-9 rounded cursor-pointer border border-gray-300 p-0.5">
                    <input type="text" id="colorText" value="<?= h($old['color'] ?? '#176B23') ?>"
                        class="flex-1 px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none"
                        oninput="document.querySelector('[name=color]').value=this.value">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                <input type="number" name="sort_order" value="<?= (int)($old['sort_order'] ?? 0) ?>" min="0"
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none">
            </div>
        </div>

        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none">
                    <option value="published" <?= ($old['status'] ?? 'published') === 'published' ? 'selected' : '' ?>>Published</option>
                    <option value="draft"     <?= ($old['status'] ?? '') === 'draft'               ? 'selected' : '' ?>>Draft</option>
                </select>
            </div>
        </div>

        <div class="flex items-center gap-3 pt-2 border-t border-gray-100">
            <button type="submit" class="px-5 py-2 bg-primary text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition-colors">
                <?= $isEdit ? 'Save Changes' : 'Create Member' ?>
            </button>
            <a href="<?= url('/admin/team') ?>" class="px-5 py-2 text-sm text-gray-500 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Cancel</a>
        </div>
    </form>
</div>

<style>
/* ---- Range slider styling ---- */
.pos-range-slider {
    -webkit-appearance: none;
    appearance: none;
    height: 6px;
    border-radius: 3px;
    background: #e5e7eb;
    outline: none;
    transition: background 0.2s;
}
.pos-range-slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: #176B23;
    cursor: pointer;
    border: 2px solid #fff;
    box-shadow: 0 1px 4px rgba(0,0,0,0.2);
    transition: transform 0.15s ease, box-shadow 0.15s ease;
}
.pos-range-slider::-webkit-slider-thumb:hover {
    transform: scale(1.15);
    box-shadow: 0 2px 8px rgba(23,107,35,0.35);
}
.pos-range-slider::-moz-range-thumb {
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: #176B23;
    cursor: pointer;
    border: 2px solid #fff;
    box-shadow: 0 1px 4px rgba(0,0,0,0.2);
}
.pos-range-slider:focus {
    background: linear-gradient(90deg, #176B23 0%, #e5e7eb 100%);
}
.pos-preset-btn.active {
    border-color: #176B23 !important;
    background: rgba(23,107,35,0.08) !important;
    color: #176B23 !important;
    font-weight: 700 !important;
}
</style>

<script>
(function() {
    var xSlider   = document.getElementById('posXSlider');
    var ySlider   = document.getElementById('posYSlider');
    var xLabel    = document.getElementById('posXLabel');
    var yLabel    = document.getElementById('posYLabel');
    var input     = document.getElementById('objPosInput');
    var preview   = document.getElementById('posPreviewImg');
    var panel     = document.getElementById('posEditorPanel');
    var fileInput = document.getElementById('photoFileInput');
    var pathInput = document.getElementById('photoPathInput');

    // ---- Update preview from sliders ----
    function updateFromSliders() {
        var x = xSlider.value;
        var y = ySlider.value;
        xLabel.textContent = x + '%';
        yLabel.textContent = y + '%';
        var val = x + '% ' + y + '%';
        input.value = val;
        preview.style.objectPosition = val;
        updateSliderTrack(xSlider, x);
        updateSliderTrack(ySlider, y);
        highlightPreset(val);
    }

    // ---- Colored track fill ----
    function updateSliderTrack(slider, val) {
        var pct = ((val - slider.min) / (slider.max - slider.min)) * 100;
        slider.style.background = 'linear-gradient(90deg, #176B23 0%, #176B23 ' + pct + '%, #e5e7eb ' + pct + '%, #e5e7eb 100%)';
    }

    // ---- Highlight matching preset ----
    function highlightPreset(val) {
        var btns = document.querySelectorAll('.pos-preset-btn');
        for (var i = 0; i < btns.length; i++) {
            if (btns[i].getAttribute('data-val') === val) {
                btns[i].classList.add('active');
            } else {
                btns[i].classList.remove('active');
            }
        }
    }

    // ---- Parse CSS object-position → X/Y percentages ----
    function parsePosition(val) {
        val = (val || 'center 20%').trim().toLowerCase();
        var keywords = { 'left': 0, 'center': 50, 'right': 100, 'top': 0, 'bottom': 100 };
        var parts = val.split(/\s+/);
        var x = 50, y = 50;

        function parsePart(s) {
            if (keywords[s] !== undefined) return keywords[s];
            return parseFloat(s) || 50;
        }

        if (parts.length === 1) {
            var v = parsePart(parts[0]);
            // Single keyword: if it's a vertical keyword, it's Y
            if (parts[0] === 'top' || parts[0] === 'bottom') { x = 50; y = v; }
            else { x = v; y = 50; }
        } else {
            // Two-value: first is X, second is Y (standard CSS rule)
            // But CSS also handles "top left" → remap
            var p0 = parts[0], p1 = parts[1];
            if (p0 === 'top' || p0 === 'bottom') {
                // Swap: first is Y keyword
                y = parsePart(p0);
                x = parsePart(p1);
            } else {
                x = parsePart(p0);
                y = parsePart(p1);
            }
        }
        return { x: Math.round(Math.min(100, Math.max(0, x))), y: Math.round(Math.min(100, Math.max(0, y))) };
    }

    // ---- Apply a preset ----
    window.applyPreset = function(val) {
        input.value = val;
        preview.style.objectPosition = val;
        var pos = parsePosition(val);
        xSlider.value = pos.x;
        ySlider.value = pos.y;
        xLabel.textContent = pos.x + '%';
        yLabel.textContent = pos.y + '%';
        updateSliderTrack(xSlider, pos.x);
        updateSliderTrack(ySlider, pos.y);
        highlightPreset(val);
    };

    // ---- Sync sliders from manual input ----
    window.syncSlidersFromInput = function() {
        var val = input.value.trim();
        preview.style.objectPosition = val;
        var pos = parsePosition(val);
        xSlider.value = pos.x;
        ySlider.value = pos.y;
        xLabel.textContent = pos.x + '%';
        yLabel.textContent = pos.y + '%';
        updateSliderTrack(xSlider, pos.x);
        updateSliderTrack(ySlider, pos.y);
        highlightPreset(val);
    };

    // Wire sliders
    xSlider.addEventListener('input', updateFromSliders);
    ySlider.addEventListener('input', updateFromSliders);

    // ---- Show panel & preview when new file selected ----
    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                panel.style.display = 'block';
            };
            reader.readAsDataURL(this.files[0]);
        }
    });

    // ---- Sync preview when photo_path changes ----
    var pathDebounce;
    pathInput.addEventListener('input', function() {
        clearTimeout(pathDebounce);
        var v = this.value.trim();
        pathDebounce = setTimeout(function() {
            if (v) {
                var base = document.querySelector('base');
                var baseUrl = '<?= rtrim(SITE_URL, '/') ?>/';
                var src = v;
                if (v.indexOf('http') !== 0) {
                    if (v.indexOf('uploads/') === 0) src = baseUrl + v;
                    else src = baseUrl + 'assets/' + v;
                }
                preview.src = src;
                panel.style.display = 'block';
            }
        }, 400);
    });

    // ---- Initialize sliders from current value ----
    var initVal = input.value || 'center 20%';
    var initPos = parsePosition(initVal);
    xSlider.value = initPos.x;
    ySlider.value = initPos.y;
    xLabel.textContent = initPos.x + '%';
    yLabel.textContent = initPos.y + '%';
    updateSliderTrack(xSlider, initPos.x);
    updateSliderTrack(ySlider, initPos.y);
    highlightPreset(initVal);

    // ---- Color sync ----
    document.querySelector('[name=color]').addEventListener('input', function() {
        document.getElementById('colorText').value = this.value;
    });
})();
</script>
