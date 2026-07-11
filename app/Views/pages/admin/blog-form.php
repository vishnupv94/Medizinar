<?php
$isEdit = isset($post) && isset($post->id);
?>

<div class="max-w-4xl">
    <div class="mb-4">
        <a href="<?= url('/admin/blog') ?>" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-primary transition-colors">
            <svg class="w-4 h-4" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Blog Posts
        </a>
    </div>

    <?php if ($msg = flash('success')): ?>
        <div class="mb-4 rounded-lg bg-green-50 border border-green-200 text-green-800 px-4 py-3 text-sm"><?= h($msg) ?></div>
    <?php endif; ?>

    <form method="POST" action="<?= $isEdit ? url('/admin/blog/' . $post->id) : url('/admin/blog') ?>" enctype="multipart/form-data"
        class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

        <?= csrf_field() ?>

        <div class="px-5 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-800"><?= $isEdit ? 'Edit Blog Post' : 'Create Blog Post' ?></h2>
        </div>

        <div class="p-5 space-y-5">

            <!-- Title -->
            <div>
                <label for="blog-title" class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="blog-title" value="<?= h($post->title ?? '') ?>" required
                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none <?= isset($errors['title']) ? 'border-red-400' : '' ?>"
                    placeholder="Enter blog post title…">
                <?php if (isset($errors['title'])): ?>
                    <p class="mt-1 text-xs text-red-600"><?= h($errors['title']) ?></p>
                <?php endif; ?>
            </div>

            <!-- Slug -->
            <div>
                <label for="blog-slug" class="block text-sm font-medium text-gray-700 mb-1">
                    URL Slug
                    <span class="text-xs font-normal text-gray-400 ml-1">Auto-generated from title. Edit if needed.</span>
                </label>
                <div class="flex items-center gap-0">
                    <span class="px-3 py-2.5 bg-gray-50 border border-r-0 border-gray-300 rounded-l-lg text-sm text-gray-500">/blog/</span>
                    <input type="text" name="slug" id="blog-slug" value="<?= h($post->slug ?? '') ?>"
                        class="flex-1 px-3 py-2.5 border border-gray-300 rounded-r-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none"
                        placeholder="my-blog-post-title">
                </div>
            </div>

            <!-- Excerpt -->
            <div>
                <label for="blog-excerpt" class="block text-sm font-medium text-gray-700 mb-1">
                    Excerpt
                    <span class="text-xs font-normal text-gray-400 ml-1">Short summary for listing cards & SEO meta description</span>
                </label>
                <textarea name="excerpt" id="blog-excerpt" rows="2"
                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none resize-y"
                    placeholder="A brief summary of the post…"><?= h($post->excerpt ?? '') ?></textarea>
            </div>

            <!-- Content -->
            <div>
                <label for="blog-content" class="block text-sm font-medium text-gray-700 mb-1">Content <span class="text-red-500">*</span></label>
                <textarea name="content" id="blog-content" rows="16" required
                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary outline-none resize-y leading-relaxed <?= isset($errors['content']) ? 'border-red-400' : '' ?>"
                    placeholder="Write your blog post content here…"><?= h($post->content ?? '') ?></textarea>
                <?php if (isset($errors['content'])): ?>
                    <p class="mt-1 text-xs text-red-600"><?= h($errors['content']) ?></p>
                <?php endif; ?>
                <p class="mt-1 text-xs text-gray-400">Use the rich text editor above to write and format your post.</p>
            </div>

            <!-- Banner Image -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Banner Image</label>

                <?php if ($isEdit && !empty($post->image)): ?>
                    <div class="mb-3 relative inline-block" id="current-image-wrap">
                        <img src="<?= url('uploads/blog/' . h($post->image)) ?>" alt="Current banner"
                            class="w-64 h-40 object-cover rounded-lg border border-gray-200 shadow-sm"
                            style="object-position:<?= h($post->banner_pos ?? 'center center') ?>; transform-origin:<?= h($post->banner_pos ?? 'center center') ?>; transform: scale(<?= h($post->banner_scale ?? 1.00) ?>);">
                        <label class="absolute top-2 right-2 flex items-center gap-1 px-2 py-1 bg-red-500 text-white text-xs font-medium rounded-md cursor-pointer hover:bg-red-600 transition-colors">
                            <input type="checkbox" name="remove_image" value="1" class="hidden" id="remove-image-cb"
                                onchange="document.getElementById('current-image-wrap').style.opacity = this.checked ? '0.4' : '1'">
                            <svg class="w-3.5 h-3.5" width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Remove
                        </label>
                    </div>
                <?php endif; ?>

                <input type="file" name="image" accept="image/jpeg,image/png,image/webp" id="blog-image"
                    class="block text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 file:cursor-pointer file:transition-colors">
                <?php if (isset($errors['image'])): ?>
                    <p class="mt-1 text-xs text-red-600"><?= h($errors['image']) ?></p>
                <?php endif; ?>
                <p class="mt-1 text-xs text-gray-400">JPG, PNG, or WebP. Max 5 MB.</p>
                <div class="mt-2 px-3 py-2 rounded-lg bg-blue-50 border border-blue-100">
                    <p class="text-xs font-medium text-blue-700">📐 Recommended: 1920 × 500 px (3.84 : 1 ratio)</p>
                    <p class="text-[11px] text-blue-500 mt-0.5">Banner displays full-width on the blog page. Use a wide, landscape image for best results.</p>
                </div>

                <!-- Image preview (for new uploads before save) -->
                <div id="image-preview-wrap" class="mt-3 hidden">
                    <img id="image-preview" src="" alt="Preview" class="w-64 h-40 object-cover rounded-lg border border-gray-200 shadow-sm">
                </div>
            </div>

            <!-- ===== Banner Position / Zoom / Resize Editor ===== -->
            <?php
            $bannerImgUrl = ($isEdit && !empty($post->image))
                ? url('uploads/blog/' . h($post->image))
                : '';
            $bannerPos   = h($post->banner_pos ?? 'center center');
            $bannerScale = (float)($post->banner_scale ?? 1.00);
            ?>
            <div id="bannerEditorPanel" style="display:<?= $bannerImgUrl ? 'block' : 'none' ?>">
                <label class="block text-sm font-medium text-gray-700 mb-3">
                    Banner Crop, Zoom & Resize
                    <span class="text-xs font-normal text-gray-400 ml-1">— adjust how the banner is framed on the blog page</span>
                </label>

                <div class="space-y-5">
                    <!-- Live Preview (matches frontend: full-width, 1920×500 ratio) -->
                    <div>
                        <div id="bannerPreviewCard" style="width:100%; aspect-ratio:1920/500; border-radius:12px; overflow:hidden; border:1px solid #e5e7eb; box-shadow:0 2px 10px rgba(0,0,0,0.08); position:relative; background:#f3f4f6;">
                            <img id="bannerPreviewImg" src="<?= h($bannerImgUrl) ?>" alt="Preview"
                                 style="width:100%; height:100%; object-fit:cover; object-position:<?= $bannerPos ?>; transform-origin:<?= $bannerPos ?>; transform: scale(<?= $bannerScale ?>); display:block;">
                            <!-- Gradient overlay matching the frontend -->
                            <div style="position:absolute; bottom:0; left:0; right:0; height:50%;
                                        background:linear-gradient(to top, rgba(0,0,0,0.25) 0%, transparent 100%); pointer-events:none;"></div>
                        </div>
                        <p class="text-[10px] text-gray-400 text-center mt-1.5">Live Preview — matches blog page banner (1920 × 500 px)</p>
                    </div>

                    <!-- Controls -->
                    <div class="space-y-4">
                        <!-- Range Sliders -->
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            <div>
                                <label class="flex items-center justify-between text-xs font-medium text-gray-600 mb-1">
                                    <span>Horizontal (X)</span>
                                    <span id="blogPosXLabel" class="tabular-nums text-primary font-semibold">50%</span>
                                </label>
                                <input type="range" id="blogPosXSlider" min="0" max="100" value="50" step="1"
                                    class="blog-range-slider w-full">
                                <div class="flex justify-between text-[10px] text-gray-400 mt-0.5">
                                    <span>Left</span><span>Center</span><span>Right</span>
                                </div>
                            </div>
                            <div>
                                <label class="flex items-center justify-between text-xs font-medium text-gray-600 mb-1">
                                    <span>Vertical (Y)</span>
                                    <span id="blogPosYLabel" class="tabular-nums text-primary font-semibold">50%</span>
                                </label>
                                <input type="range" id="blogPosYSlider" min="0" max="100" value="50" step="1"
                                    class="blog-range-slider w-full">
                                <div class="flex justify-between text-[10px] text-gray-400 mt-0.5">
                                    <span>Top</span><span>Center</span><span>Bottom</span>
                                </div>
                            </div>
                            <div>
                                <label class="flex items-center justify-between text-xs font-medium text-gray-600 mb-1">
                                    <span>Zoom</span>
                                    <span id="blogZoomLabel" class="tabular-nums text-primary font-semibold">1.00x</span>
                                </label>
                                <input type="range" id="blogZoomSlider" min="1.0" max="3.0" value="<?= $bannerScale ?>" step="0.05"
                                    class="blog-range-slider w-full">
                                <div class="flex justify-between text-[10px] text-gray-400 mt-0.5">
                                    <span>1x</span><span>2x</span><span>3x</span>
                                </div>
                            </div>
                            <div>
                                <label class="flex items-center justify-between text-xs font-medium text-gray-600 mb-1">
                                    <span>Resize</span>
                                    <span id="blogResizeLabel" class="tabular-nums text-primary font-semibold">1.00x</span>
                                </label>
                                <input type="range" id="blogResizeSlider" min="0.1" max="2.0" value="<?= $bannerScale ?>" step="0.05"
                                    class="blog-range-slider w-full">
                                <div class="flex justify-between text-[10px] text-gray-400 mt-0.5">
                                    <span>0.1x</span><span>1x</span><span>2x</span>
                                </div>
                            </div>
                        </div>
                        <!-- Hidden inputs for form submission -->
                        <input type="hidden" name="banner_pos" id="blogPosInput" value="<?= $bannerPos ?>">
                        <input type="hidden" name="banner_scale" id="blogScaleInput" value="<?= $bannerScale ?>">
                    </div>
                </div>
            </div>
            <!-- ===== / Banner Position Editor ===== -->

        </div>

        <!-- Actions -->
        <div class="px-5 py-4 border-t border-gray-100 bg-gray-50 flex flex-wrap items-center gap-3">
            <?php if ($isEdit && $post->status === 'published'): ?>
                <button type="submit" name="action" value="publish"
                    class="px-5 py-2.5 bg-primary text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition-colors">
                    Update & Publish
                </button>
                <button type="submit" name="action" value="unpublish"
                    class="px-5 py-2.5 bg-amber-500 text-white text-sm font-medium rounded-lg hover:bg-amber-600 transition-colors">
                    Unpublish (Draft)
                </button>
            <?php else: ?>
                <button type="submit" name="action" value="publish"
                    class="px-5 py-2.5 bg-primary text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition-colors">
                    Publish
                </button>
                <button type="submit" name="action" value="draft"
                    class="px-5 py-2.5 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition-colors">
                    Save as Draft
                </button>
            <?php endif; ?>

            <?php if ($isEdit): ?>
                <a href="<?= url('/admin/blog/' . $post->id . '/preview') ?>"
                    class="px-5 py-2.5 text-sm font-medium text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-100 transition-colors">
                    Preview
                </a>
            <?php endif; ?>

            <a href="<?= url('/admin/blog') ?>"
                class="px-5 py-2.5 text-sm text-gray-500 hover:text-gray-700 transition-colors ml-auto">Cancel</a>
        </div>
    </form>
</div>

<style>
/* ---- Blog banner range slider styling ---- */
.blog-range-slider {
    -webkit-appearance: none;
    appearance: none;
    height: 6px;
    border-radius: 3px;
    background: #e5e7eb;
    outline: none;
    transition: background 0.2s;
}
.blog-range-slider::-webkit-slider-thumb {
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
.blog-range-slider::-webkit-slider-thumb:hover {
    transform: scale(1.15);
    box-shadow: 0 2px 8px rgba(23,107,35,0.35);
}
.blog-range-slider::-moz-range-thumb {
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: #176B23;
    cursor: pointer;
    border: 2px solid #fff;
    box-shadow: 0 1px 4px rgba(0,0,0,0.2);
}
.blog-range-slider:focus {
    background: linear-gradient(90deg, #176B23 0%, #e5e7eb 100%);
}
</style>

<script>
// Auto-generate slug from title
(function() {
    const titleInput = document.getElementById('blog-title');
    const slugInput  = document.getElementById('blog-slug');
    let slugEdited   = <?= ($isEdit && !empty($post->slug)) ? 'true' : 'false' ?>;

    // Track if user manually edited slug
    slugInput.addEventListener('input', function() {
        slugEdited = true;
    });

    titleInput.addEventListener('input', function() {
        if (!slugEdited || slugInput.value === '') {
            slugInput.value = titleInput.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/[\s-]+/g, '-')
                .replace(/^-+|-+$/g, '');
            slugEdited = false;
        }
    });
})();

// Image preview + banner editor panel show
document.getElementById('blog-image').addEventListener('change', function(e) {
    var wrap = document.getElementById('image-preview-wrap');
    var img  = document.getElementById('image-preview');
    var panel = document.getElementById('bannerEditorPanel');
    var bannerImg = document.getElementById('bannerPreviewImg');
    if (e.target.files && e.target.files[0]) {
        var reader = new FileReader();
        reader.onload = function(ev) {
            img.src = ev.target.result;
            wrap.classList.remove('hidden');
            // Also update banner editor preview
            if (bannerImg) {
                bannerImg.src = ev.target.result;
                panel.style.display = 'block';
            }
        };
        reader.readAsDataURL(e.target.files[0]);
    } else {
        wrap.classList.add('hidden');
    }
});

// ===== Banner Position / Zoom / Resize Editor =====
(function() {
    var xSlider     = document.getElementById('blogPosXSlider');
    var ySlider     = document.getElementById('blogPosYSlider');
    var zoomSlider  = document.getElementById('blogZoomSlider');
    var resizeSlider= document.getElementById('blogResizeSlider');
    var xLabel      = document.getElementById('blogPosXLabel');
    var yLabel      = document.getElementById('blogPosYLabel');
    var zoomLabel   = document.getElementById('blogZoomLabel');
    var resizeLabel = document.getElementById('blogResizeLabel');
    var input       = document.getElementById('blogPosInput');
    var scaleInput  = document.getElementById('blogScaleInput');
    var preview     = document.getElementById('bannerPreviewImg');

    if (!xSlider) return; // Guard if elements not rendered

    // ---- Update preview from sliders ----
    function updateFromSliders() {
        var x = xSlider.value;
        var y = ySlider.value;
        var z = parseFloat(zoomSlider.value).toFixed(2);
        var r = parseFloat(resizeSlider.value).toFixed(2);
        xLabel.textContent = x + '%';
        yLabel.textContent = y + '%';
        zoomLabel.textContent = z + 'x';
        resizeLabel.textContent = r + 'x';
        var val = x + '% ' + y + '%';
        input.value = val;
        // Combine zoom and resize into one scale value
        var combinedScale = (parseFloat(z) * parseFloat(r)).toFixed(2);
        scaleInput.value = combinedScale;
        preview.style.objectPosition = val;
        preview.style.transformOrigin = val;
        preview.style.transform = 'scale(' + combinedScale + ')';
        updateSliderTrack(xSlider, x);
        updateSliderTrack(ySlider, y);
        updateSliderTrack(zoomSlider, z);
        updateSliderTrack(resizeSlider, r);
    }

    // ---- Colored track fill ----
    function updateSliderTrack(slider, val) {
        var pct = ((val - slider.min) / (slider.max - slider.min)) * 100;
        slider.style.background = 'linear-gradient(90deg, #176B23 0%, #176B23 ' + pct + '%, #e5e7eb ' + pct + '%, #e5e7eb 100%)';
    }

    // ---- Parse CSS object-position → X/Y percentages ----
    function parsePosition(val) {
        val = (val || 'center center').trim().toLowerCase();
        var keywords = { 'left': 0, 'center': 50, 'right': 100, 'top': 0, 'bottom': 100 };
        var parts = val.split(/\s+/);
        var x = 50, y = 50;

        function parsePart(s) {
            if (keywords[s] !== undefined) return keywords[s];
            return parseFloat(s) || 50;
        }

        if (parts.length === 1) {
            var v = parsePart(parts[0]);
            if (parts[0] === 'top' || parts[0] === 'bottom') { x = 50; y = v; }
            else { x = v; y = 50; }
        } else {
            var p0 = parts[0], p1 = parts[1];
            if (p0 === 'top' || p0 === 'bottom') {
                y = parsePart(p0);
                x = parsePart(p1);
            } else {
                x = parsePart(p0);
                y = parsePart(p1);
            }
        }
        return { x: Math.round(Math.min(100, Math.max(0, x))), y: Math.round(Math.min(100, Math.max(0, y))) };
    }

    // Wire sliders
    xSlider.addEventListener('input', updateFromSliders);
    ySlider.addEventListener('input', updateFromSliders);
    zoomSlider.addEventListener('input', updateFromSliders);
    resizeSlider.addEventListener('input', updateFromSliders);

    // ---- Initialize sliders from current value ----
    var initVal = input.value || 'center center';
    var initPos = parsePosition(initVal);
    var initScale = parseFloat(scaleInput.value) || 1.00;
    // For init, set zoom to 1 and resize to the stored scale (or both 1 if scale is 1)
    var initZoom = 1.00;
    var initResize = initScale;
    // If scale > 3 (the max zoom), distribute between zoom and resize
    if (initScale > 3.0) { initZoom = 3.0; initResize = initScale / 3.0; }
    // If scale > 1 and resize would be > 2, put excess in zoom
    if (initResize > 2.0) { initZoom = initScale / 2.0; initResize = 2.0; }

    xSlider.value = initPos.x;
    ySlider.value = initPos.y;
    zoomSlider.value = initZoom;
    resizeSlider.value = initResize;
    xLabel.textContent = initPos.x + '%';
    yLabel.textContent = initPos.y + '%';
    zoomLabel.textContent = initZoom.toFixed(2) + 'x';
    resizeLabel.textContent = initResize.toFixed(2) + 'x';
    updateSliderTrack(xSlider, initPos.x);
    updateSliderTrack(ySlider, initPos.y);
    updateSliderTrack(zoomSlider, initZoom);
    updateSliderTrack(resizeSlider, initResize);
})();
</script>

<!-- TinyMCE WYSIWYG Editor -->
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#blog-content',
        height: 500,
        menubar: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | ' +
            'bold italic forecolor backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'link table | removeformat | code fullscreen | help',
        content_style: 'body { font-family: "DM Sans", sans-serif; font-size: 14px; line-height: 1.6; }',
        setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });
        }
    });

    // Sync on form submit
    document.querySelector('form').addEventListener('submit', function() {
        tinymce.triggerSave();
    });
</script>

