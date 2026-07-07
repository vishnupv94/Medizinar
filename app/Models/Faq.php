<?php

namespace App\Models;

use App\Core\Database;

class Faq
{
    public static function create(array $data): int
    {
        return Database::getInstance()->insert('faqs', $data);
    }

    public static function update(int $id, array $data): void
    {
        Database::getInstance()->update('faqs', $data, 'id = ?', [$id]);
    }

    public static function findById(int $id): ?object
    {
        return Database::getInstance()->fetch(
            'SELECT * FROM faqs WHERE id = ? LIMIT 1',
            [$id]
        );
    }

    public static function getPublished(): array
    {
        return Database::getInstance()->fetchAll(
            'SELECT * FROM faqs WHERE status = ? ORDER BY sort_order ASC, created_at DESC',
            ['published']
        );
    }

    public static function getAll(int $limit = 20, int $offset = 0): array
    {
        return Database::getInstance()->fetchAll(
            'SELECT * FROM faqs ORDER BY sort_order ASC, created_at DESC LIMIT ? OFFSET ?',
            [$limit, $offset]
        );
    }

    public static function count(): int
    {
        return Database::getInstance()->count('faqs');
    }

    public static function countPublished(): int
    {
        return Database::getInstance()->count('faqs', 'status = ?', ['published']);
    }

    public static function countDraft(): int
    {
        return Database::getInstance()->count('faqs', 'status = ?', ['draft']);
    }

    public static function getFiltered(string $q = '', int $limit = 20, int $offset = 0): array
    {
        if ($q !== '') {
            $like = '%' . $q . '%';
            return Database::getInstance()->fetchAll(
                'SELECT * FROM faqs WHERE question LIKE ? OR answer LIKE ? ORDER BY sort_order ASC, created_at DESC LIMIT ? OFFSET ?',
                [$like, $like, $limit, $offset]
            );
        }
        return self::getAll($limit, $offset);
    }

    public static function countFiltered(string $q = ''): int
    {
        if ($q !== '') {
            $like = '%' . $q . '%';
            return Database::getInstance()->count(
                'faqs',
                'question LIKE ? OR answer LIKE ?',
                [$like, $like]
            );
        }
        return self::count();
    }

    public static function delete(int $id): void
    {
        Database::getInstance()->delete('faqs', 'id = ?', [$id]);
    }
}
