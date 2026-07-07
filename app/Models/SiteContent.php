<?php

namespace App\Models;

use App\Core\Database;

/**
 * Key-value list store for grouped site content blocks.
 * Groups: why_us | stats | trust_bullets | core_values | why_reasons | commitments
 */
class SiteContent
{
    // ----------------------------------------------------------------
    // Read helpers
    // ----------------------------------------------------------------

    /** Returns all published rows for a group, ordered by sort_order. */
    public static function getGroup(string $groupKey): array
    {
        return Database::getInstance()->fetchAll(
            'SELECT * FROM site_content WHERE group_key = ? AND status = "published"
             ORDER BY sort_order ASC, id ASC',
            [$groupKey]
        );
    }

    /** Returns all rows for a group regardless of status (admin use). */
    public static function getGroupAll(string $groupKey): array
    {
        return Database::getInstance()->fetchAll(
            'SELECT * FROM site_content WHERE group_key = ?
             ORDER BY sort_order ASC, id ASC',
            [$groupKey]
        );
    }

    public static function getFiltered(string $groupKey = '', string $q = '', int $limit = 30, int $offset = 0): array
    {
        $db     = Database::getInstance();
        $wheres = [];
        $params = [];

        if ($groupKey !== '') {
            $wheres[] = 'group_key = ?';
            $params[] = $groupKey;
        }
        if ($q !== '') {
            $wheres[] = '(label LIKE ? OR value LIKE ?)';
            $params[] = "%$q%";
            $params[] = "%$q%";
        }

        $where    = $wheres ? ('WHERE ' . implode(' AND ', $wheres)) : '';
        $params[] = $limit;
        $params[] = $offset;

        return $db->fetchAll(
            "SELECT * FROM site_content $where ORDER BY group_key ASC, sort_order ASC, id ASC LIMIT ? OFFSET ?",
            $params
        );
    }

    public static function countFiltered(string $groupKey = '', string $q = ''): int
    {
        $db     = Database::getInstance();
        $wheres = [];
        $params = [];

        if ($groupKey !== '') {
            $wheres[] = 'group_key = ?';
            $params[] = $groupKey;
        }
        if ($q !== '') {
            $wheres[] = '(label LIKE ? OR value LIKE ?)';
            $params[] = "%$q%";
            $params[] = "%$q%";
        }

        $where = $wheres ? ('WHERE ' . implode(' AND ', $wheres)) : '';
        $row   = $db->fetch("SELECT COUNT(*) AS c FROM site_content $where", $params);
        return (int) ($row->c ?? 0);
    }

    public static function findById(int $id): ?object
    {
        return Database::getInstance()->fetch(
            'SELECT * FROM site_content WHERE id = ?', [$id]
        );
    }

    /** Returns a list of all distinct group_key values. */
    public static function getGroups(): array
    {
        $rows = Database::getInstance()->fetchAll(
            'SELECT DISTINCT group_key FROM site_content ORDER BY group_key ASC'
        );
        return array_column($rows, 'group_key');
    }

    public static function countDraft(): int
    {
        $row = Database::getInstance()->fetch('SELECT COUNT(*) AS c FROM site_content WHERE status = "draft"');
        return (int) ($row->c ?? 0);
    }

    // ----------------------------------------------------------------
    // Write helpers
    // ----------------------------------------------------------------
    public static function create(array $data): int
    {
        $db = Database::getInstance();
        $db->query(
            'INSERT INTO site_content (group_key, item_key, label, value, icon_type, icon_value, sort_order, status)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?)',
            [
                $data['group_key'],
                $data['item_key']   ?? null,
                $data['label'],
                $data['value']      ?? null,
                $data['icon_type']  ?? '',
                $data['icon_value'] ?? null,
                (int) ($data['sort_order'] ?? 0),
                $data['status']     ?? 'published',
            ]
        );
        return (int) $db->query('SELECT LAST_INSERT_ID() AS id')->fetch()->id;
    }

    public static function update(int $id, array $data): void
    {
        Database::getInstance()->query(
            'UPDATE site_content SET group_key=?, item_key=?, label=?, value=?, icon_type=?, icon_value=?, sort_order=?, status=?
             WHERE id=?',
            [
                $data['group_key'],
                $data['item_key']   ?? null,
                $data['label'],
                $data['value']      ?? null,
                $data['icon_type']  ?? '',
                $data['icon_value'] ?? null,
                (int) ($data['sort_order'] ?? 0),
                $data['status']     ?? 'published',
                $id,
            ]
        );
    }

    public static function delete(int $id): void
    {
        Database::getInstance()->query('DELETE FROM site_content WHERE id = ?', [$id]);
    }
}
