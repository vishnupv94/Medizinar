CREATE TABLE IF NOT EXISTS `admins` (
    `id`            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name`          VARCHAR(100)  NOT NULL,
    `email`         VARCHAR(150)  NOT NULL UNIQUE,
    `password_hash` VARCHAR(255)  NOT NULL,
    `created_at`    TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,
    `updated_at`    TIMESTAMP     DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `contact_entries` (
    `id`              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name`            VARCHAR(100)  NOT NULL,
    `phone`           VARCHAR(20)   NOT NULL,
    `email`           VARCHAR(150)  DEFAULT NULL,
    `category`        VARCHAR(50)   NOT NULL,
    `subject`         VARCHAR(255)  NOT NULL,
    `message`         TEXT          NOT NULL,
    `attachment_name` VARCHAR(255)  DEFAULT NULL,
    `attachment_path` VARCHAR(255)  DEFAULT NULL,
    `ip_address`      VARCHAR(45)   DEFAULT NULL,
    `is_read`         TINYINT(1)    DEFAULT 0,
    `created_at`      TIMESTAMP     DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `appointment_entries` (
    `id`         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name`       VARCHAR(100)  NOT NULL,
    `phone`      VARCHAR(20)   NOT NULL,
    `email`      VARCHAR(150)  DEFAULT NULL,
    `service`    VARCHAR(50)   NOT NULL,
    `location`   TEXT          NOT NULL,
    `start_date` DATE          NOT NULL,
    `duration`   VARCHAR(30)   NOT NULL,
    `message`    TEXT          DEFAULT NULL,
    `ip_address` VARCHAR(45)   DEFAULT NULL,
    `is_read`    TINYINT(1)    DEFAULT 0,
    `status`     ENUM('pending','confirmed','completed','cancelled') DEFAULT 'pending',
    `created_at` TIMESTAMP     DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `site_settings` (
    `key`        VARCHAR(100)  NOT NULL PRIMARY KEY,
    `value`      TEXT          DEFAULT NULL,
    `updated_at` TIMESTAMP     DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Seed default settings (INSERT IGNORE so existing values are never overwritten)
INSERT IGNORE INTO `site_settings` (`key`, `value`) VALUES
    ('RECAPTCHA_SITE_KEY',   ''),
    ('RECAPTCHA_SECRET_KEY', ''),
    ('GOOGLE_MAPS_EMBED_URL', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3942.5!2d76.7795!3d8.9905!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b05f82a4b3e9e9b%3A0x0!2sKottarakkara%2C+Kollam%2C+Kerala!5e0!3m2!1sen!2sin!4v1');
