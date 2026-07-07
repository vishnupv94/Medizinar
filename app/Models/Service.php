<?php

namespace App\Models;

use App\Core\Database;

class Service
{
    // -------------------------------------------------------
    // Public reads
    // -------------------------------------------------------

    public static function findBySlug(string $slug): ?object
    {
        return Database::getInstance()->fetch(
            'SELECT * FROM services WHERE slug = ? AND status = ? LIMIT 1',
            [$slug, 'published']
        );
    }

    public static function findById(int $id): ?object
    {
        return Database::getInstance()->fetch(
            'SELECT * FROM services WHERE id = ? LIMIT 1',
            [$id]
        );
    }

    public static function getPublished(): array
    {
        return Database::getInstance()->fetchAll(
            'SELECT * FROM services WHERE status = ? ORDER BY sort_order ASC',
            ['published']
        );
    }

    // -------------------------------------------------------
    // Admin reads
    // -------------------------------------------------------

    public static function getAll(int $limit = 50, int $offset = 0): array
    {
        return Database::getInstance()->fetchAll(
            'SELECT * FROM services ORDER BY sort_order ASC, id ASC LIMIT ? OFFSET ?',
            [$limit, $offset]
        );
    }

    public static function getFiltered(string $q = '', int $limit = 50, int $offset = 0): array
    {
        if ($q !== '') {
            $like = '%' . $q . '%';
            return Database::getInstance()->fetchAll(
                'SELECT * FROM services WHERE title LIKE ? OR h1 LIKE ? OR slug LIKE ?
                 ORDER BY sort_order ASC LIMIT ? OFFSET ?',
                [$like, $like, $like, $limit, $offset]
            );
        }
        return self::getAll($limit, $offset);
    }

    public static function count(): int
    {
        return Database::getInstance()->count('services');
    }

    public static function countPublished(): int
    {
        return Database::getInstance()->count('services', 'status = ?', ['published']);
    }

    public static function countDraft(): int
    {
        return Database::getInstance()->count('services', 'status = ?', ['draft']);
    }

    public static function countFiltered(string $q = ''): int
    {
        if ($q !== '') {
            $like = '%' . $q . '%';
            return Database::getInstance()->count(
                'services',
                'title LIKE ? OR h1 LIKE ? OR slug LIKE ?',
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
        return Database::getInstance()->insert('services', $data);
    }

    public static function update(int $id, array $data): void
    {
        Database::getInstance()->update('services', $data, 'id = ?', [$id]);
    }

    public static function delete(int $id): void
    {
        // service_faqs cascade via FK; no extra cleanup needed
        Database::getInstance()->delete('services', 'id = ?', [$id]);
    }

    // -------------------------------------------------------
    // FAQs (child table)
    // -------------------------------------------------------

    public static function getFaqs(int $serviceId): array
    {
        return Database::getInstance()->fetchAll(
            'SELECT * FROM service_faqs WHERE service_id = ? ORDER BY sort_order ASC, id ASC',
            [$serviceId]
        );
    }

    public static function replaceFaqs(int $serviceId, array $faqs): void
    {
        $db = Database::getInstance();
        $db->delete('service_faqs', 'service_id = ?', [$serviceId]);
        foreach ($faqs as $i => $faq) {
            if (trim($faq['question']) === '' || trim($faq['answer']) === '') {
                continue;
            }
            $db->insert('service_faqs', [
                'service_id' => $serviceId,
                'question'   => trim($faq['question']),
                'answer'     => trim($faq['answer']),
                'sort_order' => $i + 1,
            ]);
        }
    }

    // -------------------------------------------------------
    // Helpers
    // -------------------------------------------------------

    /**
     * Decode the JSON features column into a PHP array.
     * Returns an empty array on failure.
     */
    public static function decodeFeatures(object $service): array
    {
        if (empty($service->features)) {
            return [];
        }
        $decoded = json_decode($service->features, true);
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
        return Database::getInstance()->count('services', $where, $params) > 0;
    }
}
