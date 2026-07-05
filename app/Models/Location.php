<?php

namespace App\Models;

use App\Core\Database;

class Location
{
    // -------------------------------------------------------
    // Public reads
    // -------------------------------------------------------

    public static function findBySlug(string $slug): ?object
    {
        return Database::getInstance()->fetch(
            'SELECT * FROM locations WHERE slug = ? AND status = ? LIMIT 1',
            [$slug, 'published']
        );
    }

    public static function findById(int $id): ?object
    {
        return Database::getInstance()->fetch(
            'SELECT * FROM locations WHERE id = ? LIMIT 1',
            [$id]
        );
    }

    public static function getPublished(): array
    {
        return Database::getInstance()->fetchAll(
            'SELECT * FROM locations WHERE status = ? ORDER BY sort_order ASC, id ASC',
            ['published']
        );
    }

    // -------------------------------------------------------
    // Admin reads
    // -------------------------------------------------------

    public static function getAll(int $limit = 50, int $offset = 0): array
    {
        return Database::getInstance()->fetchAll(
            'SELECT * FROM locations ORDER BY sort_order ASC, id ASC LIMIT ? OFFSET ?',
            [$limit, $offset]
        );
    }

    public static function getFiltered(string $q = '', int $limit = 50, int $offset = 0): array
    {
        if ($q !== '') {
            $like = '%' . $q . '%';
            return Database::getInstance()->fetchAll(
                'SELECT * FROM locations WHERE name LIKE ? OR slug LIKE ? OR title LIKE ?
                 ORDER BY sort_order ASC LIMIT ? OFFSET ?',
                [$like, $like, $like, $limit, $offset]
            );
        }
        return self::getAll($limit, $offset);
    }

    public static function count(): int
    {
        return Database::getInstance()->count('locations');
    }

    public static function countPublished(): int
    {
        return Database::getInstance()->count('locations', 'status = ?', ['published']);
    }

    public static function countDraft(): int
    {
        return Database::getInstance()->count('locations', 'status = ?', ['draft']);
    }

    public static function countFiltered(string $q = ''): int
    {
        if ($q !== '') {
            $like = '%' . $q . '%';
            return Database::getInstance()->count(
                'locations',
                'name LIKE ? OR slug LIKE ? OR title LIKE ?',
                [$like, $like, $like]
            );
        }
        return self::count();
    }

    // -------------------------------------------------------
    // Writes
    // -------------------------------------------------------

    public static function create(array $data): int
    {
        return Database::getInstance()->insert('locations', $data);
    }

    public static function update(int $id, array $data): void
    {
        Database::getInstance()->update('locations', $data, 'id = ?', [$id]);
    }

    public static function delete(int $id): void
    {
        Database::getInstance()->delete('locations', 'id = ?', [$id]);
    }

    // -------------------------------------------------------
    // Helpers
    // -------------------------------------------------------

    /**
     * Decode the JSON localities column into a PHP array.
     */
    public static function decodeLocalities(object $location): array
    {
        if (empty($location->localities)) {
            return [];
        }
        $decoded = json_decode($location->localities, true);
        return is_array($decoded) ? $decoded : [];
    }

    /**
     * Validate slug uniqueness (excluding a given id for edits).
     */
    public static function slugExists(string $slug, ?int $excludeId = null): bool
    {
        $where  = 'slug = ?';
        $params = [$slug];
        if ($excludeId !== null) {
            $where  .= ' AND id != ?';
            $params[] = $excludeId;
        }
        return Database::getInstance()->count('locations', $where, $params) > 0;
    }
}
