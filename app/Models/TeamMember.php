<?php

namespace App\Models;

use App\Core\Database;

class TeamMember
{
    // ----------------------------------------------------------------
    // Read helpers
    // ----------------------------------------------------------------
    public static function getPublished(): array
    {
        return Database::getInstance()->fetchAll(
            'SELECT * FROM team_members WHERE status = "published"
             ORDER BY sort_order ASC, id ASC'
        );
    }

    public static function getFiltered(string $q = '', int $limit = 20, int $offset = 0): array
    {
        $db = Database::getInstance();
        if ($q !== '') {
            return $db->fetchAll(
                'SELECT * FROM team_members WHERE name LIKE ? OR role LIKE ?
                 ORDER BY sort_order ASC, id ASC LIMIT ? OFFSET ?',
                ["%$q%", "%$q%", $limit, $offset]
            );
        }
        return $db->fetchAll(
            'SELECT * FROM team_members ORDER BY sort_order ASC, id ASC LIMIT ? OFFSET ?',
            [$limit, $offset]
        );
    }

    public static function countFiltered(string $q = ''): int
    {
        $db = Database::getInstance();
        if ($q !== '') {
            $row = $db->fetch(
                'SELECT COUNT(*) AS c FROM team_members WHERE name LIKE ? OR role LIKE ?',
                ["%$q%", "%$q%"]
            );
        } else {
            $row = $db->fetch('SELECT COUNT(*) AS c FROM team_members');
        }
        return (int) ($row->c ?? 0);
    }

    public static function findById(int $id): ?object
    {
        return Database::getInstance()->fetch('SELECT * FROM team_members WHERE id = ?', [$id]);
    }

    public static function countDraft(): int
    {
        $row = Database::getInstance()->fetch('SELECT COUNT(*) AS c FROM team_members WHERE status = "draft"');
        return (int) ($row->c ?? 0);
    }

    // ----------------------------------------------------------------
    // Write helpers
    // ----------------------------------------------------------------
    public static function create(array $data): int
    {
        $db = Database::getInstance();
        $sql = 'INSERT INTO team_members (name, role, initial, color, bio, photo, obj_pos, obj_scale, status, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $params = [
            $data['name'],
            $data['role'],
            $data['initial']    ?? null,
            $data['color']      ?? '#176B23',
            $data['bio']        ?? null,
            $data['photo']      ?? null,
            $data['obj_pos']    ?? 'center top',
            (float) ($data['obj_scale'] ?? 1.00),
            $data['status']     ?? 'published',
            (int) ($data['sort_order'] ?? 0),
        ];

        try {
            $db->query($sql, $params);
        } catch (\PDOException $e) {
            if (strpos($e->getMessage(), 'Unknown column \'obj_scale\'') !== false) {
                $db->query('ALTER TABLE team_members ADD COLUMN obj_scale DECIMAL(4,2) DEFAULT 1.00 AFTER obj_pos');
                $db->query($sql, $params);
            } else {
                throw $e;
            }
        }
        return (int) $db->query('SELECT LAST_INSERT_ID() AS id')->fetch()->id;
    }

    public static function update(int $id, array $data): void
    {
        $sql = 'UPDATE team_members SET name=?, role=?, initial=?, color=?, bio=?, photo=?, obj_pos=?, obj_scale=?, status=?, sort_order=? WHERE id=?';
        $params = [
            $data['name'],
            $data['role'],
            $data['initial']    ?? null,
            $data['color']      ?? '#176B23',
            $data['bio']        ?? null,
            $data['photo']      ?? null,
            $data['obj_pos']    ?? 'center top',
            (float) ($data['obj_scale'] ?? 1.00),
            $data['status']     ?? 'published',
            (int) ($data['sort_order'] ?? 0),
            $id,
        ];
        
        try {
            Database::getInstance()->query($sql, $params);
        } catch (\PDOException $e) {
            if (strpos($e->getMessage(), 'Unknown column \'obj_scale\'') !== false) {
                Database::getInstance()->query('ALTER TABLE team_members ADD COLUMN obj_scale DECIMAL(4,2) DEFAULT 1.00 AFTER obj_pos');
                Database::getInstance()->query($sql, $params);
            } else {
                throw $e;
            }
        }
    }

    public static function delete(int $id): void
    {
        Database::getInstance()->query('DELETE FROM team_members WHERE id = ?', [$id]);
    }
}
