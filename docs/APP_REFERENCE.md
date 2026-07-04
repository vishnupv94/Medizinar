# Medizinar Care — App Reference

> Developer reference for the custom PHP application powering medizinarcare.com.
> Use this document to locate files, understand patterns, and know where to make changes.

---

## Table of Contents

1. [Technology Stack](#technology-stack)
2. [Folder Structure](#folder-structure)
3. [Request Lifecycle](#request-lifecycle)
4. [Framework Core](#framework-core)
5. [Routing](#routing)
6. [Controllers](#controllers)
7. [Views & Layouts](#views--layouts)
8. [Partials](#partials)
9. [Models](#models)
10. [Helpers & Global Functions](#helpers--global-functions)
11. [Configuration & Environment](#configuration--environment)
12. [Database](#database)
13. [Admin Panel](#admin-panel)
14. [Assets](#assets)
15. [Security](#security)
16. [Deployment](#deployment)
17. [Common Tasks](#common-tasks)

---

## Technology Stack

| Layer        | Technology                                      |
|--------------|-------------------------------------------------|
| Language     | PHP 8.3 (ea-php83 on cPanel)                    |
| Framework    | Custom — no Composer, no external PHP packages  |
| Database     | MySQL via PDO                                   |
| CSS          | Vanilla CSS (`assets/css/app.css`) + Tailwind CDN |
| JS           | Vanilla JS (`assets/js/app.js`)                 |
| Font         | DM Sans (Google Fonts)                          |
| Hosting      | cPanel shared hosting (cPanel Git deployment)   |
| Session      | PHP file-based sessions (`tmp/sessions/`)       |
| Mail         | PHP `mail()` function (SMTP configured via cPanel) |

---

## Folder Structure

```
medizinarcare.skyhine.com/
│
├── index.php                  ← Front controller (single entry point)
├── .htaccess                  ← URL rewriting, security headers, caching
├── .env                       ← Environment variables (NOT deployed)
├── .cpanel.yml                ← cPanel Git deployment tasks
├── robots.txt
│
├── app/                       ← All application PHP code
│   ├── bootstrap.php          ← Autoloader, env load, session start, CSRF init
│   ├── routes.php             ← All route definitions
│   │
│   ├── Config/
│   │   └── app.php            ← Site-wide constants (SITE_NAME, PHONE, EMAIL, etc.)
│   │
│   ├── Core/                  ← Framework primitives
│   │   ├── Controller.php     ← Base controller (view(), redirect(), guardAdmin())
│   │   ├── Database.php       ← PDO singleton with query helpers
│   │   ├── Env.php            ← .env file parser
│   │   └── Router.php         ← HTTP router (GET/POST, named params)
│   │
│   ├── Controllers/           ← Request handlers
│   │   ├── PageController.php         ← Public static pages
│   │   ├── ContactController.php      ← Contact form (GET + POST)
│   │   ├── AppointmentController.php  ← Appointment form (GET + POST)
│   │   ├── BlogController.php         ← Blog listing + single post
│   │   ├── FaqController.php          ← FAQ listing
│   │   ├── SitemapController.php      ← XML sitemap generation
│   │   └── Admin/                     ← Admin-only controllers
│   │       ├── AuthController.php         ← Login / logout
│   │       ├── DashboardController.php    ← Admin dashboard
│   │       ├── EntryController.php        ← View contact & appointment submissions
│   │       ├── BlogController.php         ← Blog CRUD
│   │       ├── FaqController.php          ← FAQ CRUD
│   │       └── SettingsController.php     ← Site settings + password change
│   │
│   ├── Models/                ← Database access layer (thin query wrappers)
│   │   ├── Admin.php
│   │   ├── AppointmentEntry.php
│   │   ├── BlogPost.php
│   │   ├── ContactEntry.php
│   │   ├── Faq.php
│   │   └── SiteSetting.php
│   │
│   ├── Helpers/               ← Utility classes
│   │   ├── functions.php      ← Global helper functions (url, asset, h, db, partial, etc.)
│   │   ├── Csrf.php           ← CSRF token generation & verification
│   │   ├── Flash.php          ← One-shot session flash messages
│   │   ├── Html.php           ← HTML escaping, WhatsApp link builder
│   │   ├── Recaptcha.php      ← Google reCAPTCHA v3 integration
│   │   └── Validator.php      ← Input sanitization, phone/email validation
│   │
│   └── Views/
│       ├── layouts/
│       │   ├── main.php       ← Public layout (head, nav, footer, scripts)
│       │   ├── admin.php      ← Admin layout
│       │   └── auth.php       ← Login-only layout
│       │
│       ├── pages/             ← Page content (injected as $content into layouts)
│       │   ├── home.php
│       │   ├── about.php
│       │   ├── services.php
│       │   ├── team.php
│       │   ├── contact.php
│       │   ├── appointment.php
│       │   ├── blog.php
│       │   ├── blog-single.php
│       │   ├── faq.php
│       │   ├── privacy-policy.php
│       │   ├── terms-and-conditions.php
│       │   ├── disclaimer.php
│       │   ├── refund-policy.php
│       │   ├── 404.php
│       │   └── admin/         ← Admin panel views
│       │
│       └── partials/          ← Reusable view fragments
│           ├── nav.php
│           ├── footer.php
│           ├── topbar.php
│           ├── inner-hero.php
│           ├── cta.php
│           ├── feature-list.php
│           ├── floating-buttons.php
│           └── success-popup.php
│
├── assets/                    ← Public static files
│   ├── css/app.css            ← Custom CSS (animations, overrides, components)
│   ├── js/app.js              ← Custom JS (nav, forms, interactions)
│   ├── images/                ← Site images (.webp preferred)
│   └── site.webmanifest
│
├── database/
│   ├── migration.sql          ← Full schema (run once to create all tables)
│   └── setup.php              ← Runs migration.sql via PDO (called on deploy)
│
├── uploads/
│   ├── blog/                  ← Blog post images (publicly served)
│   └── contact/               ← Contact form attachments (NOT publicly accessible)
│
├── tmp/
│   └── sessions/              ← PHP session files (chmod 700, server-managed)
│
├── docs/                      ← Developer & legal docs (NOT deployed to server)
│   ├── APP_REFERENCE.md       ← This file
│   └── legal/                 ← Source PDF documents
│       ├── Privacy Policy.pdf
│       ├── Terms & Conditions.pdf
│       ├── Disclaimer.pdf
│       └── Refund Policy.pdf
│
└── scripts/                   ← Local dev utilities (NOT deployed)
    └── optimize-images.js
```

---

## Request Lifecycle

```
Browser → .htaccess (rewrite all non-file requests to index.php)
        → index.php
            → app/bootstrap.php   (autoload, env, session, CSRF)
            → app/routes.php      (register all routes, return $router)
            → $router->dispatch() (match method + URI)
                → Controller::method()
                    → $this->view('page-name', $data)
                        → ob_start() + require Views/pages/page.php  → $content
                        → require Views/layouts/main.php              → full HTML output
```

Static files (`.css`, `.js`, `.webp`, `.pdf`) are served directly by Apache — they never touch PHP.

---

## Framework Core

### `app/Core/Env.php`
Parses `.env` into memory. Access values with `env('KEY', $default)`.

### `app/Core/Router.php`
Registers `GET` and `POST` routes. Supports named URL segments (`{slug}`, `{id}`).
- `$router->get('/path', [Controller::class, 'method'])`
- `$router->post('/path', [Controller::class, 'method'])`

Named segments are passed as positional arguments to the controller method:
```php
$router->get('/blog/{slug}', [BlogController::class, 'show']);
// → public function show(string $slug): void
```

### `app/Core/Controller.php`
Base class all controllers extend.

| Method | Purpose |
|--------|---------|
| `$this->view(string $page, array $data)` | Renders `Views/pages/{page}.php` inside the current layout |
| `$this->redirect(string $url, array $flash)` | Redirect with optional flash message |
| `$this->guardAdmin()` | Checks session for admin auth; redirects to login if missing or expired |
| `$this->layout` | Property — set to `'admin'` or `'auth'` to use a different layout |

### `app/Core/Database.php`
PDO singleton. Access via global `db()` helper.

| Method | Usage |
|--------|-------|
| `db()->query($sql, $params)` | Raw prepared query, returns `PDOStatement` |
| `db()->fetch($sql, $params)` | Returns first row as `stdClass` or `null` |
| `db()->fetchAll($sql, $params)` | Returns all rows as array of `stdClass` |
| `db()->insert($table, $data)` | INSERT, returns last insert ID |
| `db()->update($table, $data, $where, $params)` | UPDATE, returns affected rows |
| `db()->delete($table, $where, $params)` | DELETE, returns affected rows |
| `db()->count($table, $where, $params)` | Returns COUNT as int |

---

## Routing

All routes are defined in `app/routes.php`. Routes are matched in order. The file must `return $router;`.

**Pattern:**
```php
$router->get('/url',       [ControllerClass::class, 'methodName']);
$router->post('/url',      [ControllerClass::class, 'methodName']);
$router->get('/url/{id}',  [ControllerClass::class, 'methodName']); // dynamic segment
```

**To add a new page:**
1. Add a route in `app/routes.php`
2. Add a method in the appropriate controller
3. Create a view file in `app/Views/pages/`

---

## Controllers

Each controller class extends `App\Core\Controller`. Methods are called directly by the router — no constructor injection.

### Public controllers

| File | Handles |
|------|---------|
| `PageController.php` | Static pages: home, about, services, team, privacy policy, terms, disclaimer, refund policy |
| `ContactController.php` | Contact form display (`index`) and form submission (`submit`) |
| `AppointmentController.php` | Appointment form display (`index`) and form submission (`submit`) |
| `BlogController.php` | Blog listing (`index`) and single post (`show($slug)`) |
| `FaqController.php` | FAQ page with all active FAQs from DB |
| `SitemapController.php` | Generates `sitemap.xml` dynamically |

### Admin controllers (all call `$this->guardAdmin()` first)

| File | Handles |
|------|---------|
| `Admin/AuthController.php` | Login form, login POST, logout |
| `Admin/DashboardController.php` | Admin home with stats |
| `Admin/EntryController.php` | View/delete contact & appointment submissions |
| `Admin/BlogController.php` | Blog CRUD (list, create, edit, update, delete, preview) |
| `Admin/FaqController.php` | FAQ CRUD |
| `Admin/SettingsController.php` | Site settings (stored in DB) + password change |

**Passing data to views:**
```php
$this->view('my-page', [
    'pageTitle' => 'Page Title',
    'metaDesc'  => 'SEO description',
    'items'     => $items,          // available as $items in the view
]);
```

---

## Views & Layouts

### How views work

`Controller::view()` does two things:
1. Captures the page content: `require Views/pages/{page}.php` → stored in `$content`
2. Renders the layout: `require Views/layouts/{layout}.php` — which outputs `$content` where `<?= $content ?>` appears

All variables passed to `view()` are available in **both** the page file and the layout (via `extract()`).

### Layouts

| File | Used by |
|------|---------|
| `layouts/main.php` | All public-facing pages |
| `layouts/admin.php` | All admin panel pages |
| `layouts/auth.php` | Admin login page |

`main.php` handles: `<head>` (title, meta, OG tags, JSON-LD schema), Tailwind config, fonts, nav, footer, scripts.

**Special layout variables:**

| Variable | Purpose |
|----------|---------|
| `$pageTitle` | Used in `<title>` and OG title |
| `$metaDesc` | Used in meta description and OG description |
| `$jsonLd` | Page-specific JSON-LD structured data (array, auto-encoded) |
| `$ogImage` | Custom OG image URL (falls back to `og-image.png`) |
| `$page` | Active nav item key (e.g. `'home'`, `'about'`) for nav highlighting |

### Page files

Located in `app/Views/pages/`. Each file is pure PHP/HTML — it outputs the *inner* content of the page only (no `<html>`, `<head>`, `<body>` tags).

---

## Partials

Called via `partial('name', $data)` from any view or layout.

| Partial | Purpose | Key variables |
|---------|---------|---------------|
| `nav.php` | Main navigation | `$page` (active key) |
| `footer.php` | Site footer with all columns | — |
| `topbar.php` | Top announcement bar | — |
| `inner-hero.php` | Hero banner for inner pages | `$breadcrumb`, `$heroTitle`, `$heroDescription` |
| `cta.php` | Call-to-action section | — |
| `feature-list.php` | Icon + text feature grid | — |
| `floating-buttons.php` | Fixed WhatsApp/Call buttons | — |
| `success-popup.php` | Flash success modal | — |

**Usage:**
```php
<?php partial('inner-hero', [
    'breadcrumb'      => 'About Us',
    'heroTitle'       => 'About Us',
    'heroDescription' => 'Short description shown below the title.',
]) ?>
```

---

## Models

Located in `app/Models/`. Each model is a class with static methods that use `db()` to query the database. No ORM — all SQL is written manually using prepared statements.

| Model | Table(s) | Key methods |
|-------|----------|-------------|
| `Admin.php` | `admins` | `findByEmail()`, `updatePassword()` |
| `ContactEntry.php` | `contact_entries` | `create()`, `all()`, `find()`, `delete()` |
| `AppointmentEntry.php` | `appointment_entries` | `create()`, `all()`, `find()`, `updateStatus()`, `delete()` |
| `BlogPost.php` | `blog_posts` | `all()`, `allPublished()`, `findBySlug()`, `create()`, `update()`, `delete()` |
| `Faq.php` | `faqs` | `allActive()`, `all()`, `find()`, `create()`, `update()`, `delete()` |
| `SiteSetting.php` | `site_settings` | `get($key)`, `set($key, $value)`, `all()` |

---

## Helpers & Global Functions

Defined in `app/Helpers/functions.php` and available everywhere after bootstrap.

| Function | Returns | Purpose |
|----------|---------|---------|
| `env($key, $default)` | mixed | Read `.env` value |
| `db()` | Database | Database singleton |
| `h($string)` | string | HTML-escape (XSS protection) — use on all user output |
| `url($path)` | string | Absolute URL: `SITE_URL . '/' . $path` |
| `asset($path)` | string | Absolute URL to `assets/` directory |
| `partial($name, $data)` | void | Include a partial view |
| `csrf_token()` | string | Current CSRF token |
| `csrf_field()` | string | Hidden `<input>` with CSRF token |
| `csrf_verify($token)` | bool | Validate submitted token |
| `flash($key)` | ?string | Read and clear a flash message |
| `whatsapp_link($num, $msg)` | string | Build a `https://wa.me/` URL |
| `sanitize_input($value)` | string | Strip tags, trim whitespace |
| `validate_phone($phone)` | bool | 10-digit Indian phone validation |
| `validate_email($email)` | bool | Standard email format check |
| `recaptcha_enabled()` | bool | Whether reCAPTCHA keys are configured |
| `recaptcha_verify($token)` | bool | Server-side reCAPTCHA v3 check |
| `recaptcha_site_key()` | string | Public reCAPTCHA site key |

---

## Configuration & Environment

### `app/Config/app.php` — compile-time constants

Edit this file to change site-wide values that don't vary by environment.

| Constant | Value |
|----------|-------|
| `SITE_NAME` | `'Medizinar Care'` |
| `SITE_TAGLINE` | `'Compassionate Home Healthcare'` |
| `SITE_URL` | Read from `.env` |
| `PHONE` / `PHONE_DISPLAY` / `WHATSAPP_NUM` | Contact numbers |
| `EMAIL` | Contact email |
| `ADDRESS_LINE1/2/3` | Physical address |
| `MAIL_TO/FROM/FROM_NAME` | Mail routing (overridable via `.env`) |
| `RECAPTCHA_SITE_KEY/SECRET_KEY` | reCAPTCHA (via `.env`) |
| `GOOGLE_MAPS_EMBED_URL` | Maps embed URL (via `.env`) |
| `NAV_LINKS` | Array of `[label, href, key]` for main nav |

### `.env` — runtime secrets (never committed)

```env
SITE_URL=https://medizinarcare.com
DB_HOST=localhost
DB_PORT=3306
DB_NAME=...
DB_USER=...
DB_PASS=...
MAIL_TO=...
MAIL_FROM=...
MAIL_FROM_NAME=...
RECAPTCHA_SITE_KEY=...
RECAPTCHA_SECRET_KEY=...
GOOGLE_MAPS_EMBED_URL=...
ADMIN_SESSION_LIFETIME=3600
```

---

## Database

### Schema — `database/migration.sql`

The migration is idempotent (`CREATE TABLE IF NOT EXISTS`). Running `setup.php` again is safe.

**Tables:**

| Table | Purpose |
|-------|---------|
| `admins` | Admin user accounts (bcrypt passwords) |
| `contact_entries` | Contact form submissions |
| `appointment_entries` | Appointment form submissions |
| `blog_posts` | Blog articles (slug, title, content, image, published flag) |
| `faqs` | FAQ items (question, answer, active flag, sort order) |
| `site_settings` | Key-value store for admin-editable settings |

### `database/setup.php`

Called automatically on every cPanel Git deployment. Reads `migration.sql` and executes it, creating tables that don't exist yet. Does **not** drop or truncate existing tables.

---

## Admin Panel

**URL:** `/admin` (redirects to `/admin/dashboard`)  
**Login:** `/admin/login`

All admin routes are prefixed with `/admin`. Every admin controller method begins with `$this->guardAdmin()`.

### Session guard

`guardAdmin()` in `Core/Controller.php`:
- Checks `$_SESSION['admin_id']` exists
- Checks last activity within `ADMIN_SESSION_LIFETIME` seconds (default: 3600)
- On failure: redirects to `/admin/login`

### Admin features

| Feature | Route prefix | Controller |
|---------|-------------|------------|
| Dashboard (stats) | `/admin/dashboard` | `DashboardController` |
| Contact entries | `/admin/entries/contact` | `EntryController` |
| Appointment entries | `/admin/entries/appointments` | `EntryController` |
| Blog management | `/admin/blog` | `Admin\BlogController` |
| FAQ management | `/admin/faqs` | `Admin\FaqController` |
| Site settings | `/admin/settings` | `SettingsController` |

---

## Assets

| Path | Purpose |
|------|---------|
| `assets/css/app.css` | Custom CSS — animations, `inner-hero` styles, `hero-pattern`, form styles, admin styles |
| `assets/js/app.js` | Custom JS — mobile nav, sticky nav on scroll, form validation, AJAX submissions, countdown |
| `assets/images/` | All site images in `.webp` format |
| `assets/site.webmanifest` | PWA manifest |

**Tailwind CSS** is loaded from CDN in `layouts/main.php` with a custom config (primary green + accent gold colour tokens). It is **not** installed locally — no build step.

**Cache busting:** Asset URLs include a `?v=` query string using `filemtime()`:
```php
asset('css/app.css') . '?v=' . filemtime(ROOT_PATH . '/assets/css/app.css')
```

---

## Security

| Mechanism | Where |
|-----------|-------|
| CSRF tokens | All POST forms — `<?= csrf_field() ?>` in form, `csrf_verify()` in controller |
| XSS protection | All user output wrapped in `h()` |
| SQL injection | All DB queries use PDO prepared statements via `db()` helpers |
| `.env` protection | `.htaccess` blocks `.env` via hidden-file rule; never committed |
| `app/` protection | `.htaccess` `RewriteRule ^app/ - [F,L]` blocks direct access |
| `uploads/contact/` | Blocked by `.htaccess`; only `uploads/blog/` images are public |
| Admin session timeout | Configurable via `ADMIN_SESSION_LIFETIME` in `.env` (default 3600s) |
| reCAPTCHA v3 | Applied to contact and appointment forms when keys are set |
| Security headers | Set in `.htaccess`: `X-Content-Type-Options`, `X-Frame-Options`, `X-XSS-Protection`, `Referrer-Policy`, `Permissions-Policy` |

---

## Deployment

Deployment is triggered by a **cPanel Git** push. Configuration is in `.cpanel.yml`.

**What gets deployed (rsync to server):**

| Included | Excluded |
|----------|---------|
| `app/` | `.git/` |
| `assets/` | `.env` |
| `database/` | `docs/` |
| `index.php` | `scripts/` |
| `.htaccess` | `node_modules/` |
| `robots.txt` | `package.json` / `package-lock.json` |
| | `.claude/` / `.vscode/` |
| | `uploads/` (preserved on server) |
| | `tmp/` (managed on server) |
| | `error_log` |

**Post-deploy steps (automatic):**
1. Set directory permissions: `755`
2. Set `app/` PHP files: `644`
3. Set `assets/` files: `644`
4. Ensure `uploads/contact/` exists with `755`
5. Ensure `tmp/sessions/` exists with `700`
6. Run `database/setup.php` (applies any new migrations)

**The `.env` file must be manually placed on the server.** It is never deployed via Git.

---

## Common Tasks

### Add a new public page

1. **Route** — `app/routes.php`:
   ```php
   $router->get('/new-page', [PageController::class, 'newPage']);
   ```

2. **Controller method** — `app/Controllers/PageController.php`:
   ```php
   public function newPage(): void
   {
       $this->view('new-page', [
           'page'      => '',
           'pageTitle' => 'Page Title',
           'metaDesc'  => 'SEO description.',
       ]);
   }
   ```

3. **View** — `app/Views/pages/new-page.php`:
   ```php
   <?php partial('inner-hero', [
       'breadcrumb'      => 'New Page',
       'heroTitle'       => 'New Page',
       'heroDescription' => 'Short description.',
   ]) ?>

   <section class="py-16 bg-gray-50">
       <div class="max-w-4xl mx-auto px-4 sm:px-6">
           <!-- content -->
       </div>
   </section>

   <?php partial('cta') ?>
   ```

---

### Add a new DB-driven feature

1. Add table to `database/migration.sql`
2. Create `app/Models/MyModel.php` with static methods using `db()`
3. Create controller, route, and view as above
4. For admin CRUD: add controller in `Admin/`, add routes under `/admin/`, add view in `pages/admin/`

---

### Change contact information

Edit `app/Config/app.php` — change `PHONE`, `PHONE_DISPLAY`, `WHATSAPP_NUM`, `EMAIL`, `ADDRESS_LINE*` constants.

---

### Change site navigation links

Edit the `NAV_LINKS` array in `app/Config/app.php`. The `key` value is matched against `$page` passed from the controller to highlight the active link.

---

### Add a footer link

Edit `app/Views/partials/footer.php`. The footer is a 5-column grid (`lg:grid-cols-5`):
1. Logo + social icons (`lg:col-span-1`)
2. Quick Links
3. Legal
4. Our Services
5. Contact Info

---

### Change Tailwind colours or fonts

Edit the `tailwind.config` block inside `app/Views/layouts/main.php` (inline `<script>` tag). The primary green and accent gold tokens are defined there.

---

### Add custom CSS or JS

- **CSS** → `assets/css/app.css`
- **JS** → `assets/js/app.js`

Both files are loaded on every public page via `main.php`. Cache busting is automatic via `filemtime()`.

---

### Run locally (PHP built-in server)

```bash
# From project root
php -S localhost:8000

# index.php handles static file passthrough for the built-in server
```

Ensure `.env` has `SITE_URL=http://localhost:8000`.
