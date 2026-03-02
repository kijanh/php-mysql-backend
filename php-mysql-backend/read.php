<?php
// read.php

declare(strict_types=1);
require_once __DIR__ . "/config.php";

function read_users(PDO $pdo): array
{
    $stmt = $pdo->query("SELECT id, ime, prezime, email, created_at FROM users ORDER BY id DESC");
    return $stmt->fetchAll();
}

// Ako se pozove direktno preko browsera/fetch-a, vrati JSON
if (php_sapi_name() !== "cli" && basename($_SERVER["SCRIPT_NAME"]) === "read.php") {
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode(read_users($pdo), JSON_UNESCAPED_UNICODE);
    exit;
}