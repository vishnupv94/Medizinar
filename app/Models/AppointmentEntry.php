<?php

namespace App\Models;

use App\Core\Database;

class AppointmentEntry
{
    public static function create(array $data): int
    {
        return Database::getInstance()->insert('appointment_entries', $data);
    }

    public static function findById(int $id): ?object
    {
        return Database::getInstance()->fetch(
            'SELECT * FROM appointment_entries WHERE id = ? LIMIT 1',
            [$id]
        );
    }

    public static function getAll(int $limit = 20, int $offset = 0): array
    {
        return Database::getInstance()->fetchAll(
            'SELECT * FROM appointment_entries ORDER BY created_at DESC LIMIT ? OFFSET ?',
            [$limit, $offset]
        );
    }

    public static function count(): int
    {
        return Database::getInstance()->count('appointment_entries');
    }

    public static function countUnread(): int
    {
        return Database::getInstance()->count('appointment_entries', 'is_read = 0');
    }

    public static function countByStatus(string $status): int
    {
        return Database::getInstance()->count('appointment_entries', 'status = ?', [$status]);
    }

    public static function markRead(int $id): void
    {
        Database::getInstance()->update('appointment_entries', ['is_read' => 1], 'id = ?', [$id]);
    }

    public static function updateStatus(int $id, string $status): void
    {
        $allowed = ['pending', 'confirmed', 'completed', 'cancelled'];
        if (!in_array($status, $allowed, true)) {
            return;
        }
        Database::getInstance()->update('appointment_entries', ['status' => $status], 'id = ?', [$id]);
    }

    public static function delete(int $id): void
    {
        Database::getInstance()->delete('appointment_entries', 'id = ?', [$id]);
    }

    public static function recent(int $limit = 5): array
    {
        return Database::getInstance()->fetchAll(
            'SELECT * FROM appointment_entries ORDER BY created_at DESC LIMIT ?',
            [$limit]
        );
    }
}
