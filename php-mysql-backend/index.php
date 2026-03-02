<?php
declare(strict_types=1);
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/read.php";

$users = read_users($pdo);

$msg = trim($_GET["msg"] ?? "");
$type = ($_GET["type"] ?? "success") === "error" ? "danger" : "success";
?>
<!doctype html>
<html lang="bs">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Management - php-mysql-backend</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="assets/style.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <span class="navbar-brand fw-semibold">User Management</span>
  </div>
</nav>

<main class="container py-4">

  <?php if ($msg !== ""): ?>
    <div class="alert alert-<?= $type ?> alert-dismissible fade show" role="alert">
      <?= htmlspecialchars($msg) ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <div class="row g-4">
    <!-- CREATE FORM -->
    <div class="col-12 col-lg-4">
      <div class="card shadow-sm">
        <div class="card-header fw-semibold">Dodaj korisnika</div>
        <div class="card-body">
          <form id="createForm" action="create.php" method="POST" novalidate>
            <div class="mb-3">
              <label class="form-label">Ime</label>
              <input type="text" name="ime" class="form-control" required maxlength="100">
              <div class="invalid-feedback">Unesi ime.</div>
            </div>
            <div class="mb-3">
              <label class="form-label">Prezime</label>
              <input type="text" name="prezime" class="form-control" required maxlength="100">
              <div class="invalid-feedback">Unesi prezime.</div>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" required maxlength="150">
              <div class="invalid-feedback">Unesi ispravan email.</div>
            </div>
            <button class="btn btn-primary w-100" type="submit">Sačuvaj</button>
          </form>
        </div>
      </div>
    </div>

    <!-- TABLE -->
    <div class="col-12 col-lg-8">
      <div class="card shadow-sm">
        <div class="card-header d-flex gap-2 justify-content-between align-items-center flex-wrap">
          <span class="fw-semibold">Korisnici</span>
          <input id="searchInput" class="form-control form-control-sm w-auto" style="min-width:220px"
                 type="text" placeholder="Pretraga (ime / prezime / email)">
        </div>

        <div class="table-responsive">
          <table class="table table-striped table-hover mb-0" id="usersTable">
            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>Ime</th>
                <th>Prezime</th>
                <th>Email</th>
                <th>Datum</th>
                <th class="text-end">Akcije</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $u): ?>
                <tr>
                  <td><?= (int)$u["id"] ?></td>
                  <td><?= htmlspecialchars($u["ime"]) ?></td>
                  <td><?= htmlspecialchars($u["prezime"]) ?></td>
                  <td><?= htmlspecialchars($u["email"]) ?></td>
                  <td><?= htmlspecialchars($u["created_at"]) ?></td>
                  <td class="text-end">
                    <button
                      class="btn btn-sm btn-outline-primary btn-edit"
                      data-id="<?= (int)$u["id"] ?>"
                      data-ime="<?= htmlspecialchars($u["ime"], ENT_QUOTES) ?>"
                      data-prezime="<?= htmlspecialchars($u["prezime"], ENT_QUOTES) ?>"
                      data-email="<?= htmlspecialchars($u["email"], ENT_QUOTES) ?>"
                      type="button"
                      data-bs-toggle="modal"
                      data-bs-target="#editModal"
                    >Edit</button>

                    <button
                      class="btn btn-sm btn-outline-danger btn-delete"
                      data-id="<?= (int)$u["id"] ?>"
                      type="button"
                    >Delete</button>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <div class="card-footer small text-muted">
          Ukupno: <span id="countLabel"><?= count($users) ?></span>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- EDIT MODAL -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editForm" action="update.php" method="POST" novalidate>
        <div class="modal-header">
          <h5 class="modal-title">Edit korisnika</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="editId">

          <div class="mb-3">
            <label class="form-label">Ime</label>
            <input type="text" name="ime" id="editIme" class="form-control" required maxlength="100">
            <div class="invalid-feedback">Unesi ime.</div>
          </div>

          <div class="mb-3">
            <label class="form-label">Prezime</label>
            <input type="text" name="prezime" id="editPrezime" class="form-control" required maxlength="100">
            <div class="invalid-feedback">Unesi prezime.</div>
          </div>

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" id="editEmail" class="form-control" required maxlength="150">
            <div class="invalid-feedback">Unesi ispravan email.</div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Otkaži</button>
          <button class="btn btn-primary" type="submit">Sačuvaj</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- DELETE FORM (hidden) -->
<form id="deleteForm" action="delete.php" method="POST" class="d-none">
  <input type="hidden" name="id" id="deleteId">
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/script.js"></script>
</body>
</html>