<?php

namespace App\Models;

use App\Core\Database;

class Testimonial
{
    // ----------------------------------------------------------------
    // Read helpers
    // ----------------------------------------------------------------
    public static function getPublished(int $limit = 50, int $offset = 0): array
    {
        return Database::getInstance()->fetchAll(
            'SELECT * FROM testimonials WHERE status = "published"
             ORDER BY sort_order ASC, id ASC
             LIMIT ? OFFSET ?',
            [$limit, $offset]
        );
    }

    public static function getFiltered(string $q = '', int $limit = 20, int $offset = 0): array
    {
        $db = Database::getInstance();
        if ($q !== '') {
            return $db->fetchAll(
                'SELECT * FROM testimonials WHERE name LIKE ? OR text LIKE ?
                 ORDER BY sort_order ASC, id ASC LIMIT ? OFFSET ?',
                ["%$q%", "%$q%", $limit, $offset]
            );
        }
        return $db->fetchAll(
            'SELECT * FROM testimonials ORDER BY sort_order ASC, id ASC LIMIT ? OFFSET ?',
            [$limit, $offset]
        );
    }

    public static function countFiltered(string $q = ''): int
    {
        $db = Database::getInstance();
        if ($q !== '') {
            $row = $db->fetch(
                'SELECT COUNT(*) AS c FROM testimonials WHERE name LIKE ? OR text LIKE ?',
                ["%$q%", "%$q%"]
            );
        } else {
            $row = $db->fetch('SELECT COUNT(*) AS c FROM testimonials');
        }
        return (int) ($row->c ?? 0);
    }

    public static function findById(int $id): ?object
    {
        return Database::getInstance()->fetch('SELECT * FROM testimonials WHERE id = ?', [$id]);
    }

    public static function countDraft(): int
    {
        $row = Database::getInstance()->fetch('SELECT COUNT(*) AS c FROM testimonials WHERE status = "draft"');
        return (int) ($row->c ?? 0);
    }

    // ----------------------------------------------------------------
    // Write helpers
    // ----------------------------------------------------------------
    public static function create(array $data): int
    {
        $db = Database::getInstance();
        $db->query(
            'INSERT INTO testimonials (name, location_label, text, stars, status, sort_order)
             VALUES (?, ?, ?, ?, ?, ?)',
            [
                $data['name'],
                $data['location_label'] ?? null,
                $data['text'],
                (int) ($data['stars'] ?? 5),
                $data['status'] ?? 'published',
                (int) ($data['sort_order'] ?? 0),
            ]
        );
        return (int) $db->query('SELECT LAST_INSERT_ID() AS id')->fetch()->id;
    }

    public static function update(int $id, array $data): void
    {
        Database::getInstance()->query(
            'UPDATE testimonials SET name=?, location_label=?, text=?, stars=?, status=?, sort_order=?
             WHERE id=?',
            [
                $data['name'],
                $data['location_label'] ?? null,
                $data['text'],
                (int) ($data['stars'] ?? 5),
                $data['status'] ?? 'published',
                (int) ($data['sort_order'] ?? 0),
                $id,
            ]
        );
    }

    public static function delete(int $id): void
    {
        Database::getInstance()->query('DELETE FROM testimonials WHERE id = ?', [$id]);
    }
}
