<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
    <h2 class="mb-0">Kategorije</h2>
    <a href="index.php?controller=category&action=create" class="btn btn-primary">Dodaj kategoriju</a>
</div>

<div class="card shadow-sm">
    <div class="card-body table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Naziv</th>
                    <th>Opis</th>
                    <th class="text-end">Akcije</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($categories)): ?>
                    <tr><td colspan="4" class="text-center text-muted py-4">Nema unesenih kategorija.</td></tr>
                <?php else: ?>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td><?= (int) $category['id'] ?></td>
                            <td><?= htmlspecialchars($category['name']) ?></td>
                            <td><?= htmlspecialchars($category['description']) ?></td>
                            <td class="text-end">
                                <a href="index.php?controller=category&action=edit&id=<?= (int) $category['id'] ?>" class="btn btn-sm btn-warning">Izmijeni</a>
                                <a href="index.php?controller=category&action=delete&id=<?= (int) $category['id'] ?>" class="btn btn-sm btn-danger confirm-delete">Obriši</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
