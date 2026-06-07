<?php

namespace App\Models;

use App\Core\Database;

class SiteSetting
{
    /**
     * Fetch all settings as an associative array [ key => value ].
     */
    public static function all(): array
    {
        $db   = Database::getInstance();
        $rows = $db->fetchAll('SELECT `key`, `value` FROM `site_settings`');

        $map = [];
        foreach ($rows as $row) {
            $map[$row->key] = $row->value ?? '';
        }

        return $map;
    }

    /**
     * Get a single setting value.
     */
    public static function get(string $key, string $default = ''): string
    {
        $db  = Database::getInstance();
        $row = $db->fetch('SELECT `value` FROM `site_settings` WHERE `key` = ?', [$key]);

        return $row ? (string) ($row->value ?? '') : $default;
    }

    /**
     * Upsert a single setting.
     */
    public static function set(string $key, string $value): void
    {
        $db = Database::getInstance();
        $db->query(
            'INSERT INTO `site_settings` (`key`, `value`) VALUES (?, ?)
             ON DUPLICATE KEY UPDATE `value` = VALUES(`value`)',
            [$key, $value]
        );
    }

    /**
     * Upsert multiple settings at once.
     *
     * @param array<string,string> $data
     */
    public static function setMany(array $data): void
    {
        foreach ($data as $key => $value) {
            self::set($key, $value);
        }
    }
}
