#!/usr/bin/env node
/**
 * Medizinar Care — Image Optimisation Script
 * - Removes unused images from assets/images/
 * - Converts used images (jpg/jpeg/png) → WebP with quality tuning
 * - SVGs are kept as-is (already optimal vector format)
 * - Renames files to SEO-friendly slugs
 * - Reports file-size savings
 */

const sharp = require('sharp');
const fs    = require('fs');
const path  = require('path');

const BASE   = path.join(__dirname, '..', 'assets', 'images');
const TEAM   = path.join(BASE, 'team');

// ─── UNUSED FILES TO DELETE ──────────────────────────────────────────────────
// (duplicates / files never referenced in any PHP/CSS/JS)
const UNUSED = [
  'care-hero.jpg',        // .jpeg version is used instead
  'hero-about.svg',       // never referenced in code
  'hero-home.svg',        // never referenced in code
  'hero-services.svg',    // never referenced in code
  'hero-team.svg',        // never referenced in code
  'logo (1).png',         // duplicate of logo.png
  'logo.svg',             // never referenced in code
  'services-hero.jpg',    // .jpeg version is used instead
];

// ─── RENAME / CONVERT MAP ────────────────────────────────────────────────────
// [oldName, newWebpName, quality]
// quality: 82 for photos, 90 for icons (small, need crispness)
const CONVERT = [
  // Hero / section photos
  { src: 'hero-home.jpg',       dest: 'medizinar-care-home-hero.webp',            quality: 82 },
  { src: 'homecare.jpg',        dest: 'medizinar-care-caregiver-elderly.webp',     quality: 82 },
  { src: 'care-hero.jpeg',      dest: 'medizinar-care-doctor-stethoscope.webp',    quality: 82 },
  { src: 'about-care.jpg',      dest: 'medizinar-care-professional-caregiver.webp',quality: 82 },
  { src: 'services-hero.jpeg',  dest: 'medizinar-care-home-care-services.webp',    quality: 82 },
  { src: 'team-group.jpg',      dest: 'medizinar-care-team-group.webp',            quality: 82 },

  // Logo
  { src: 'logo.png',            dest: 'medizinar-care-logo.webp',                  quality: 92 },
  { src: 'logo.jpeg',           dest: 'medizinar-care-logo-footer.webp',           quality: 92 },

  // Value / core icons
  { src: 'icon-mission.png',      dest: 'icon-medizinar-mission.webp',      quality: 90 },
  { src: 'icon-vision.png',       dest: 'icon-medizinar-vision.webp',       quality: 90 },
  { src: 'icon-compassion.png',   dest: 'icon-medizinar-compassion.webp',   quality: 90 },
  { src: 'icon-trust.png',        dest: 'icon-medizinar-trust.webp',        quality: 90 },
  { src: 'icon-responsibility.png','dest': 'icon-medizinar-responsibility.webp', quality: 90 },
  { src: 'icon-quality.png',      dest: 'icon-medizinar-quality.webp',      quality: 90 },
  { src: 'icon-caregivers.png',   dest: 'icon-medizinar-caregivers.webp',   quality: 90 },
  { src: 'icon-reliable.png',     dest: 'icon-medizinar-reliable.webp',     quality: 90 },
  { src: 'icon-flexible.png',     dest: 'icon-medizinar-flexible.webp',     quality: 90 },
  { src: 'icon-professional.png', dest: 'icon-medizinar-professional.webp', quality: 90 },

  // Team portraits
  { src: path.join('team', 'jayahar.jpeg'), dest: path.join('team', 'medizinar-jayahar-caregiver.webp'), quality: 82 },
  { src: path.join('team', 'shani.jpeg'),   dest: path.join('team', 'medizinar-shani-caregiver.webp'),   quality: 82 },
  { src: path.join('team', 'jaya.jpeg'),    dest: path.join('team', 'medizinar-jaya-caregiver.webp'),    quality: 82 },
  { src: path.join('team', 'soumya.jpeg'),  dest: path.join('team', 'medizinar-soumya-caregiver.webp'),  quality: 82 },
];

// ─── HELPERS ─────────────────────────────────────────────────────────────────
function fmtKB(bytes) { return (bytes / 1024).toFixed(1) + ' KB'; }

async function deleteUnused() {
  console.log('\n🗑  Removing unused images…');
  for (const f of UNUSED) {
    const p = path.join(BASE, f);
    if (fs.existsSync(p)) {
      const size = fs.statSync(p).size;
      fs.unlinkSync(p);
      console.log(`   ✓ Deleted  ${f}  (${fmtKB(size)})`);
    } else {
      console.log(`   - Skipped  ${f}  (not found)`);
    }
  }
}

async function convertImages() {
  console.log('\n🔄  Converting & optimising images…\n');
  let savedTotal = 0;

  for (const item of CONVERT) {
    const srcPath  = path.join(BASE, item.src);
    const destPath = path.join(BASE, item.dest);

    if (!fs.existsSync(srcPath)) {
      console.log(`   ⚠  Source not found: ${item.src} — skipping`);
      continue;
    }

    const origSize = fs.statSync(srcPath).size;

    await sharp(srcPath)
      .webp({ quality: item.quality, effort: 6 })
      .toFile(destPath);

    const newSize = fs.statSync(destPath).size;
    const saved   = origSize - newSize;
    savedTotal   += saved;

    const pct = ((saved / origSize) * 100).toFixed(0);
    const arrow = saved >= 0 ? '▼' : '▲';
    console.log(
      `   ${saved >= 0 ? '✓' : '!'} ${path.basename(item.src).padEnd(32)} → ${path.basename(item.dest).padEnd(40)}  ` +
      `${fmtKB(origSize)} → ${fmtKB(newSize)}  (${arrow}${Math.abs(pct)}%)`
    );

    // Remove original after successful conversion
    fs.unlinkSync(srcPath);
    console.log(`      ↳ Removed original: ${item.src}`);
  }

  console.log(`\n💾  Total saved: ${fmtKB(savedTotal)}\n`);
}

(async () => {
  console.log('════════════════════════════════════════════════════════');
  console.log('  Medizinar Care — Image Optimisation');
  console.log('════════════════════════════════════════════════════════');

  await deleteUnused();
  await convertImages();

  console.log('✅  Done!  Update PHP files with new image names next.');
  console.log('════════════════════════════════════════════════════════\n');
})();
