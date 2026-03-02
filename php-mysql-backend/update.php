<?php
// update.php

declare(strict_types=1);
require_once __DIR__ . "/config.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$id = (int)($_POST["id"] ?? 0);
$ime = trim($_POST["ime"] ?? "");
$prezime = trim($_POST["prezime"] ?? "");
$email = trim($_POST["email"] ?? "");

// PHP validacija
$errors = [];
if ($id <= 0) $errors[] = "Neispravan ID.";
if ($ime === "" || mb_strlen($ime) > 100) $errors[] = "Ime je obavezno (max 100).";
if ($prezime === "" || mb_strlen($prezime) > 100) $errors[] = "Prezime je obavezno (max 100).";
if ($email === "" || mb_strlen($email) > 150 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Email nije ispravan.";
}

if ($errors) {
    header("Location: index.php?msg=" . urlencode(implode(" ", $errors)) . "&type=error");
    exit;
}

try {
    $stmt = $pdo->prepare("
        UPDATE users
        SET ime = :ime, prezime = :prezime, email = :email
        WHERE id = :id
    ");
    $stmt->execute([
        ":ime" => $ime,
        ":prezime" => $prezime,
        ":email" => $email,
        ":id" => $id
    ]);

    header("Location: index.php?msg=" . urlencode("Korisnik je izmijenjen!") . "&type=success");
    exit;

} catch (PDOException $e) {
    if ((int)($e->errorInfo[1] ?? 0) === 1062) {
        header("Location: index.php?msg=" . urlencode("Email već postoji u bazi!") . "&type=error");
        exit;
    }
    header("Location: index.php?msg=" . urlencode("Greška: " . $e->getMessage()) . "&type=error");
    exit;
}