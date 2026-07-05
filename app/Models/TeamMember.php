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
        return Database::getInstance()->query(
            'SELECT * FROM team_members WHERE status = "published"
             ORDER BY sort_order ASC, id ASC'
        );
    }

    public static function getFiltered(string $q = '', int $limit = 20, int $offset = 0): array
    {
        $db = Database::getInstance();
        if ($q !== '') {
            return $db->query(
                'SELECT * FROM team_members WHERE name LIKE ? OR role LIKE ?
                 ORDER BY sort_order ASC, id ASC LIMIT ? OFFSET ?',
                ["%$q%", "%$q%", $limit, $offset]
            );
        }
        return $db->query(
            'SELECT * FROM team_members ORDER BY sort_order ASC, id ASC LIMIT ? OFFSET ?',
            [$limit, $offset]
        );
    }

    public static function countFiltered(string $q = ''): int
    {
        $db = Database::getInstance();
        if ($q !== '') {
            $row = $db->queryOne(
                'SELECT COUNT(*) AS c FROM team_members WHERE name LIKE ? OR role LIKE ?',
                ["%$q%", "%$q%"]
            );
        } else {
            $row = $db->queryOne('SELECT COUNT(*) AS c FROM team_members');
        }
        return (int) ($row->c ?? 0);
    }

    public static function findById(int $id): ?object
    {
        return Database::getInstance()->queryOne(
            'SELECT * FROM team_members WHERE id = ?', [$id]
        ) ?: null;
    }

    public static function countDraft(): int
    {
        $row = Database::getInstance()->queryOne('SELECT COUNT(*) AS c FROM team_members WHERE status = "draft"');
        return (int) ($row->c ?? 0);
    }

    // ----------------------------------------------------------------
    // Write helpers
    // ----------------------------------------------------------------
    public static function create(array $data): int
    {
        $db = Database::getInstance();
        $db->execute(
            'INSERT INTO team_members (name, role, initial, color, bio, photo, obj_pos, status, sort_order)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)',
            [
                $data['name'],
                $data['role'],
                $data['initial']    ?? null,
                $data['color']      ?? '#176B23',
                $data['bio']        ?? null,
                $data['photo']      ?? null,
                $data['obj_pos']    ?? 'center top',
                $data['status']     ?? 'published',
                (int) ($data['sort_order'] ?? 0),
            ]
        );
        return $db->lastInsertId();
    }

    public static function update(int $id, array $data): void
    {
        Database::getInstance()->execute(
            'UPDATE team_members SET name=?, role=?, initial=?, color=?, bio=?, photo=?, obj_pos=?, status=?, sort_order=?
             WHERE id=?',
            [
                $data['name'],
                $data['role'],
                $data['initial']    ?? null,
                $data['color']      ?? '#176B23',
                $data['bio']        ?? null,
                $data['photo']      ?? null,
                $data['obj_pos']    ?? 'center top',
                $data['status']     ?? 'published',
                (int) ($data['sort_order'] ?? 0),
                $id,
            ]
        );
    }

    public static function delete(int $id): void
    {
        Database::getInstance()->execute('DELETE FROM team_members WHERE id = ?', [$id]);
    }
}
