<?php

namespace App\Models;

use App\Core\Database;

class BlogPost
{
    public static function create(array $data): int
    {
        return Database::getInstance()->insert('blog_posts', $data);
    }

    public static function update(int $id, array $data): void
    {
        Database::getInstance()->update('blog_posts', $data, 'id = ?', [$id]);
    }

    public static function findById(int $id): ?object
    {
        return Database::getInstance()->fetch(
            'SELECT * FROM blog_posts WHERE id = ? LIMIT 1',
            [$id]
        );
    }

    public static function findBySlug(string $slug): ?object
    {
        return Database::getInstance()->fetch(
            'SELECT * FROM blog_posts WHERE slug = ? AND status = ? LIMIT 1',
            [$slug, 'published']
        );
    }

    public static function getPublished(int $limit = 12, int $offset = 0): array
    {
        return Database::getInstance()->fetchAll(
            'SELECT * FROM blog_posts WHERE status = ? ORDER BY published_at DESC LIMIT ? OFFSET ?',
            ['published', $limit, $offset]
        );
    }

    public static function getAll(int $limit = 20, int $offset = 0): array
    {
        return Database::getInstance()->fetchAll(
            'SELECT * FROM blog_posts ORDER BY updated_at DESC LIMIT ? OFFSET ?',
            [$limit, $offset]
        );
    }

    public static function count(): int
    {
        return Database::getInstance()->count('blog_posts');
    }

    public static function countPublished(): int
    {
        return Database::getInstance()->count('blog_posts', 'status = ?', ['published']);
    }

    public static function countDraft(): int
    {
        return Database::getInstance()->count('blog_posts', 'status = ?', ['draft']);
    }

    public static function getFiltered(string $q = '', int $limit = 20, int $offset = 0): array
    {
        if ($q !== '') {
            $like = '%' . $q . '%';
            return Database::getInstance()->fetchAll(
                'SELECT * FROM blog_posts WHERE title LIKE ? OR content LIKE ? ORDER BY updated_at DESC LIMIT ? OFFSET ?',
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
                'blog_posts',
                'title LIKE ? OR content LIKE ?',
                [$like, $like]
            );
        }
        return self::count();
    }

    public static function delete(int $id): void
    {
        Database::getInstance()->delete('blog_posts', 'id = ?', [$id]);
    }

    public static function recent(int $limit = 5): array
    {
        return Database::getInstance()->fetchAll(
            'SELECT * FROM blog_posts ORDER BY updated_at DESC LIMIT ?',
            [$limit]
        );
    }

    public static function recentPublished(int $limit = 3): array
    {
        return Database::getInstance()->fetchAll(
            'SELECT * FROM blog_posts WHERE status = ? ORDER BY published_at DESC LIMIT ?',
            ['published', $limit]
        );
    }

    /**
     * Generate a URL-safe slug from a title. Handles duplicates by appending -2, -3, etc.
     */
    public static function generateSlug(string $title, ?int $excludeId = null): string
    {
        // Transliterate, lowercase, strip non-alphanumerics
        $slug = strtolower(trim($title));
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
        $slug = preg_replace('/[\s-]+/', '-', $slug);
        $slug = trim($slug, '-');

        if ($slug === '') {
            $slug = 'post';
        }

        // Ensure uniqueness
        $base = $slug;
        $counter = 1;
        while (true) {
            $where = 'slug = ?';
            $params = [$slug];
            if ($excludeId !== null) {
                $where .= ' AND id != ?';
                $params[] = $excludeId;
            }
            $exists = Database::getInstance()->count('blog_posts', $where, $params);
            if ($exists === 0) {
                break;
            }
            $counter++;
            $slug = $base . '-' . $counter;
        }

        return $slug;
    }
}
