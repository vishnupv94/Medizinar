<?php

require __DIR__ . '/../app/bootstrap.php';

$host = env('DB_HOST', 'localhost');
$port = env('DB_PORT', '3306');
$name = env('DB_NAME', 'medicinar');
$user = env('DB_USER', 'root');
$pass = env('DB_PASS', '');

echo "Medizinar Care — Database Setup\n";
echo str_repeat('=', 40) . "\n\n";

try {
    $pdo = new PDO("mysql:host={$host};port={$port}", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$name}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE `{$name}`");

    echo "[OK] Database '{$name}' ready.\n";

    $sql = file_get_contents(__DIR__ . '/migration.sql');
    $pdo->exec($sql);

    echo "[OK] Tables created.\n";

    $exists = $pdo->query("SELECT COUNT(*) FROM admins")->fetchColumn();

    if ((int) $exists === 0) {
        $hash = password_hash('admin123', PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("INSERT INTO admins (name, email, password_hash) VALUES (?, ?, ?)");
        $stmt->execute(['Admin', 'admin@medizinarcare.com', $hash]);
        echo "[OK] Default admin created.\n";
        echo "\n  Email    : admin@medizinarcare.com";
        echo "\n  Password : admin123";
        echo "\n\n  ** CHANGE THE DEFAULT PASSWORD AFTER FIRST LOGIN **\n";
    } else {
        echo "[--] Admin user already exists. Skipping seed.\n";
    }

    echo "\nSetup complete!\n";
} catch (PDOException $e) {
    echo "[ERROR] " . $e->getMessage() . "\n";
    exit(1);
}
