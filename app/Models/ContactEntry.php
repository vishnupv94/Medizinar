<?php

namespace App\Models;

use App\Core\Database;

class ContactEntry
{
    public static function create(array $data): int
    {
        return Database::getInstance()->insert('contact_entries', $data);
    }

    public static function findById(int $id): ?object
    {
        return Database::getInstance()->fetch(
            'SELECT * FROM contact_entries WHERE id = ? LIMIT 1',
            [$id]
        );
    }

    public static function getAll(int $limit = 20, int $offset = 0): array
    {
        return Database::getInstance()->fetchAll(
            'SELECT * FROM contact_entries ORDER BY created_at DESC LIMIT ? OFFSET ?',
            [$limit, $offset]
        );
    }

    public static function count(): int
    {
        return Database::getInstance()->count('contact_entries');
    }

    public static function countUnread(): int
    {
        return Database::getInstance()->count('contact_entries', 'is_read = 0');
    }

    public static function markRead(int $id): void
    {
        Database::getInstance()->update('contact_entries', ['is_read' => 1], 'id = ?', [$id]);
    }

    public static function delete(int $id): void
    {
        Database::getInstance()->delete('contact_entries', 'id = ?', [$id]);
    }

    public static function recent(int $limit = 5): array
    {
        return Database::getInstance()->fetchAll(
            'SELECT * FROM contact_entries ORDER BY created_at DESC LIMIT ?',
            [$limit]
        );
    }

    public static function getFiltered(string $q = '', int $limit = 20, int $offset = 0): array
    {
        if ($q !== '') {
            $like = '%' . $q . '%';
            return Database::getInstance()->fetchAll(
                'SELECT * FROM contact_entries WHERE name LIKE ? OR phone LIKE ? OR email LIKE ? OR subject LIKE ? ORDER BY created_at DESC LIMIT ? OFFSET ?',
                [$like, $like, $like, $like, $limit, $offset]
            );
        }
        return self::getAll($limit, $offset);
    }

    public static function countFiltered(string $q = ''): int
    {
        if ($q !== '') {
            $like = '%' . $q . '%';
            return Database::getInstance()->count(
                'contact_entries',
                'name LIKE ? OR phone LIKE ? OR email LIKE ? OR subject LIKE ?',
                [$like, $like, $like, $like]
            );
        }
        return self::count();
    }
}
