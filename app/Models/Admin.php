<?php

namespace App\Models;

use App\Core\Database;

class Admin
{
    public static function findByEmail(string $email): ?object
    {
        return Database::getInstance()->fetch(
            'SELECT * FROM admins WHERE email = ? LIMIT 1',
            [$email]
        );
    }

    public static function findById(int $id): ?object
    {
        return Database::getInstance()->fetch(
            'SELECT * FROM admins WHERE id = ? LIMIT 1',
            [$id]
        );
    }

    public static function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    public static function updatePassword(int $id, string $newPassword): void
    {
        Database::getInstance()->update(
            'admins',
            ['password_hash' => password_hash($newPassword, PASSWORD_BCRYPT)],
            'id = ?',
            [$id]
        );
    }
}
