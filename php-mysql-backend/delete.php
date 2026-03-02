<?php
// delete.php

declare(strict_types=1);
require_once __DIR__ . "/config.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$id = (int)($_POST["id"] ?? 0);
if ($id <= 0) {
    header("Location: index.php?msg=" . urlencode("Neispravan ID.") . "&type=error");
    exit;
}

$stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
$stmt->execute([":id" => $id]);

header("Location: index.php?msg=" . urlencode("Korisnik obrisan!") . "&type=success");
exit;