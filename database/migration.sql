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
