-- ============================================================
-- 006: Testimonials, Team Members, Site Content
-- Run: mysql -u USER -p DBNAME < database/006_testimonials_team_content.sql
-- ============================================================

-- ----------------------------------------------------------------
-- testimonials
-- ----------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `testimonials` (
    `id`             INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name`           VARCHAR(100)  NOT NULL,
    `location_label` VARCHAR(150)  DEFAULT NULL          COMMENT 'Display location, e.g. "Kollam, Kerala"',
    `text`           TEXT          NOT NULL,
    `stars`          TINYINT UNSIGNED DEFAULT 5,
    `status`         ENUM('draft','published') DEFAULT 'published',
    `sort_order`     INT           DEFAULT 0,
    `created_at`     TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,
    `updated_at`     TIMESTAMP     DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_status_sort` (`status`, `sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------------------
-- team_members
-- ----------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `team_members` (
    `id`         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name`       VARCHAR(100)  NOT NULL,
    `role`       VARCHAR(150)  NOT NULL,
    `initial`    VARCHAR(5)    DEFAULT NULL            COMMENT 'Single letter for avatar fallback',
    `color`      VARCHAR(20)   DEFAULT '#176B23'       COMMENT 'Accent hex colour',
    `bio`        TEXT          DEFAULT NULL,
    `photo`      VARCHAR(255)  DEFAULT NULL            COMMENT 'Relative path or /uploads/team/ filename',
    `obj_pos`    VARCHAR(30)   DEFAULT 'center top'   COMMENT 'CSS object-position for photo',
    `obj_scale`  DECIMAL(4,2)  DEFAULT 1.00           COMMENT 'CSS transform scale for photo zoom',
    `status`     ENUM('draft','published') DEFAULT 'published',
    `sort_order` INT           DEFAULT 0,
    `created_at` TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP     DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_status_sort` (`status`, `sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------------------
-- site_content  (ordered list items per group)
-- group_key examples: 'why_us', 'stats', 'trust_bullets',
--                     'core_values', 'why_reasons', 'commitments'
-- icon_type: 'svg' | 'path' | 'url' | 'emoji' | ''
-- ----------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `site_content` (
    `id`         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `group_key`  VARCHAR(80)   NOT NULL                COMMENT 'Logical group name',
    `item_key`   VARCHAR(80)   DEFAULT NULL            COMMENT 'Optional unique key within group',
    `label`      VARCHAR(255)  NOT NULL,
    `value`      TEXT          DEFAULT NULL            COMMENT 'Secondary value (stat number, subtitle, etc.)',
    `icon_type`  ENUM('svg','path','url','emoji','')   DEFAULT '',
    `icon_value` MEDIUMTEXT    DEFAULT NULL            COMMENT 'SVG string, URL, path, emoji char, etc.',
    `sort_order` INT           DEFAULT 0,
    `status`     ENUM('draft','published') DEFAULT 'published',
    `created_at` TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP     DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_group_sort` (`group_key`, `status`, `sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ================================================================
-- SEEDS  (INSERT IGNORE — safe to re-run)
-- ================================================================

-- ----------------------------------------------------------------
-- testimonials
-- ----------------------------------------------------------------
INSERT IGNORE INTO `testimonials` (`id`, `name`, `location_label`, `text`, `stars`, `status`, `sort_order`) VALUES
(1, 'A Happy Family', 'Kottarakkara, Kerala',
 '"Medizinar Care arranged a caring and responsible caregiver for our elderly mother. The service was professional and reliable. We are truly grateful."',
 5, 'published', 1),
(2, 'New Mother', 'Kollam, Kerala',
 '"The mother and baby care assistant was wonderful. She was very experienced, caring, and our family felt completely at ease. Highly recommended."',
 5, 'published', 2),
(3, 'NRI Family', 'Abroad',
 '"We used the NRI Parent Care service while living abroad. The team provided excellent home visits and kept us informed about our parents'' well-being."',
 5, 'published', 3);

-- ----------------------------------------------------------------
-- team_members
-- ----------------------------------------------------------------
INSERT IGNORE INTO `team_members` (`id`, `name`, `role`, `initial`, `color`, `bio`, `photo`, `obj_pos`, `obj_scale`, `status`, `sort_order`) VALUES
(1, 'Jayhar M.J.', 'Founder & Managing Partner', 'J', '#176B23',
 'Visionary leader driving Medizinar Care LLP''s mission to provide trusted, compassionate, and professional home nursing services across India. Focused on operational excellence, service quality, and client satisfaction.',
 'images/team/medizinar-jayahar-caregiver.webp', 'left top', 1.00, 'published', 1),
(2, 'Shanimol S.M.', 'Accounts & Finance Manager', 'S', '#ab7e22',
 'Responsible for financial planning, accounting operations, compliance management, budgeting, and maintaining the organization''s financial integrity and transparency.',
 'images/team/medizinar-shani-caregiver.webp', 'center 20%', 1.00, 'published', 2),
(3, 'Jaya M.', 'Client Relationship Manager', 'J', '#176B23',
 'Dedicated to ensuring exceptional client satisfaction through seamless communication, personalized support, service coordination, and long-term relationship management.',
 'images/team/medizinar-jaya-caregiver.webp', 'center 30%', 1.00, 'published', 3),
(4, 'Soumya M.', 'Brand & Digital Communications Manager', 'S', '#ab7e22',
 'Responsible for strengthening Medizinar Care LLP''s brand presence through strategic digital communication, social media management, online engagement, and marketing initiatives. Focused on building trust, increasing visibility, and connecting families with quality home healthcare services.',
 'images/team/medizinar-soumya-caregiver.webp', 'center 25%', 1.00, 'published', 4);

-- ----------------------------------------------------------------
-- site_content — why_us (home + about + services pages)
-- ----------------------------------------------------------------
INSERT IGNORE INTO `site_content` (`id`, `group_key`, `item_key`, `label`, `value`, `icon_type`, `icon_value`, `sort_order`) VALUES
(1,  'why_us', 'verified',     'Verified Caregivers',    'All caregivers are carefully selected and background checked',
 'svg', '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>',
 1),
(2,  'why_us', 'compassion',   'Compassionate Support',  'We treat every individual with kindness and respect',
 'svg', '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/></svg>',
 2),
(3,  'why_us', 'reliable',     'Reliable Service',       'Timely caregiver arrangement and dependable daily support',
 'svg', '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>',
 3),
(4,  'why_us', 'satisfaction', 'Client Satisfaction',    'Families across Kerala trust us for quality home care',
 'svg', '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/></svg>',
 4),
(5,  'why_us', 'professional', 'Professional Assistance', 'Expert caregiving support tailored to each family',
 'svg', '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 3.741-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/></svg>',
 5),
(6,  'why_us', 'flexible',     'Flexible Care Options',  'Care plans customised to your schedule and needs',
 'svg', '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>',
 6);

-- ----------------------------------------------------------------
-- site_content — stats
-- ----------------------------------------------------------------
INSERT IGNORE INTO `site_content` (`id`, `group_key`, `item_key`, `label`, `value`, `icon_type`, `icon_value`, `sort_order`) VALUES
(10, 'stats', 'families',  'Families Served',    '100+',
 'svg', '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="rgba(255,255,255,0.85)" stroke-linecap="round" stroke-linejoin="round"><path d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/></svg>',
 1),
(11, 'stats', 'services',  'Core Services',      '4+',
 'svg', '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="rgba(255,255,255,0.85)" stroke-linecap="round" stroke-linejoin="round"><path d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>',
 2),
(12, 'stats', 'support',   'Support Available',  '24/7',
 'svg', '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="rgba(255,255,255,0.85)" stroke-linecap="round" stroke-linejoin="round"><path d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>',
 3),
(13, 'stats', 'verified',  'Verified Caregivers','100%',
 'svg', '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="rgba(255,255,255,0.85)" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z"/></svg>',
 4);

-- ----------------------------------------------------------------
-- site_content — trust_bullets
-- ----------------------------------------------------------------
INSERT IGNORE INTO `site_content` (`id`, `group_key`, `item_key`, `label`, `sort_order`) VALUES
(20, 'trust_bullets', 'bg_check',    'Background-checked caregivers',        1),
(21, 'trust_bullets', 'experienced', 'Experienced patient attendants',        2),
(22, 'trust_bullets', 'elderly',     'Compassionate elderly care assistants', 3),
(23, 'trust_bullets', 'trustworthy', 'Responsible and trustworthy staff',     4);

-- ----------------------------------------------------------------
-- site_content — core_values (about page)
-- ----------------------------------------------------------------
INSERT IGNORE INTO `site_content` (`id`, `group_key`, `item_key`, `label`, `value`, `icon_type`, `icon_value`, `sort_order`) VALUES
(30, 'core_values', 'compassion',    'Compassion',     'We treat every individual with kindness, empathy, and deep respect regardless of their condition.',
 'path', 'images/icon-medizinar-compassion.webp',    1),
(31, 'core_values', 'trust',         'Trust',          'We understand the importance of trust when families invite caregivers into their homes.',
 'path', 'images/icon-medizinar-trust.webp',         2),
(32, 'core_values', 'responsibility','Responsibility', 'Our caregivers are committed to providing responsible, dependable, and consistent support.',
 'path', 'images/icon-medizinar-responsibility.webp',3),
(33, 'core_values', 'quality',       'Quality Care',   'We focus on maintaining high standards in every service we provide to every family.',
 'path', 'images/icon-medizinar-quality.webp',       4);

-- ----------------------------------------------------------------
-- site_content — why_reasons (about page icon-title cards)
-- ----------------------------------------------------------------
INSERT IGNORE INTO `site_content` (`id`, `group_key`, `item_key`, `label`, `icon_type`, `icon_value`, `sort_order`) VALUES
(40, 'why_reasons', 'caregivers',    'Compassionate Caregivers',    'path', 'images/icon-medizinar-caregivers.webp',  1),
(41, 'why_reasons', 'reliable',      'Reliable Service Support',    'path', 'images/icon-medizinar-reliable.webp',    2),
(42, 'why_reasons', 'flexible',      'Flexible Care Options',       'path', 'images/icon-medizinar-flexible.webp',    3),
(43, 'why_reasons', 'quality',       'Client Satisfaction',         'path', 'images/icon-medizinar-quality.webp',     4),
(44, 'why_reasons', 'professional',  'Professional Assistance',     'path', 'images/icon-medizinar-professional.webp',5);

-- ----------------------------------------------------------------
-- site_content — commitments (team page)
-- ----------------------------------------------------------------
INSERT IGNORE INTO `site_content` (`id`, `group_key`, `item_key`, `label`, `value`, `icon_type`, `icon_value`, `sort_order`) VALUES
(50, 'commitments', 'compassionate', 'Compassionate Care',
 'Caregivers provide support with kindness, patience, and respect for every individual.',
 'svg', '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/></svg>',
 1),
(51, 'commitments', 'trusted',       'Trusted Caregivers',
 'Carefully selected caregivers who demonstrate responsibility and dedication.',
 'svg', '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>',
 2),
(52, 'commitments', 'reliable',      'Reliable Service',
 'Timely caregiver arrangement and dependable support for families.',
 'svg', '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>',
 3),
(53, 'commitments', 'client',        'Client-Centered',
 'Every family has unique needs and we tailor our care to match those needs.',
 'svg', '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/></svg>',
 4);
