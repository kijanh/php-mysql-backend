<?php
// config.php

declare(strict_types=1);

$DB_HOST = "localhost";
$DB_NAME = "php_mysql_backend";
$DB_USER = "root";      // promijeni ako treba
$DB_PASS = "";          // promijeni ako treba
$DB_CHARSET = "utf8mb4";

$dsn = "mysql:host={$DB_HOST};dbname={$DB_NAME};charset={$DB_CHARSET}";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $DB_USER, $DB_PASS, $options);
} catch (Throwable $e) {
    http_response_code(500);
    die("Greška konekcije na bazu: " . htmlspecialchars($e->getMessage()));
}