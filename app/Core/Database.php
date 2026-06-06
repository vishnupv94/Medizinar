<?php

namespace App\Core;

class Database
{
    private static ?self $instance = null;
    private \PDO $pdo;

    private function __construct()
    {
        $dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
            env('DB_HOST', 'localhost'),
            env('DB_PORT', '3306'),
            env('DB_NAME', 'medicinar')
        );

        $this->pdo = new \PDO($dsn, env('DB_USER', 'root'), env('DB_PASS', ''), [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function query(string $sql, array $params = []): \PDOStatement
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function fetch(string $sql, array $params = []): ?object
    {
        return $this->query($sql, $params)->fetch() ?: null;
    }

    public function fetchAll(string $sql, array $params = []): array
    {
        return $this->query($sql, $params)->fetchAll();
    }

    public function insert(string $table, array $data): int
    {
        $columns      = implode(', ', array_map(fn($c) => $this->ident($c), array_keys($data)));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $table        = $this->ident($table);

        $this->query("INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})", array_values($data));
        return (int) $this->pdo->lastInsertId();
    }

    public function update(string $table, array $data, string $where, array $whereParams = []): int
    {
        $sets  = implode(', ', array_map(fn($c) => $this->ident($c) . ' = ?', array_keys($data)));
        $table = $this->ident($table);

        return $this->query(
            "UPDATE {$table} SET {$sets} WHERE {$where}",
            [...array_values($data), ...$whereParams]
        )->rowCount();
    }

    public function delete(string $table, string $where, array $params = []): int
    {
        $table = $this->ident($table);
        return $this->query("DELETE FROM {$table} WHERE {$where}", $params)->rowCount();
    }

    public function count(string $table, string $where = '1', array $params = []): int
    {
        $table = $this->ident($table);
        return (int) $this->fetch("SELECT COUNT(*) AS total FROM {$table} WHERE {$where}", $params)->total;
    }

    private function ident(string $name): string
    {
        if (!preg_match('/^[a-zA-Z_]\w*$/', $name)) {
            throw new \InvalidArgumentException("Invalid SQL identifier: {$name}");
        }
        return '`' . $name . '`';
    }
}
