<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
    <h2 class="mb-0">Knjige</h2>
    <a href="index.php?controller=book&action=create" class="btn btn-primary">Dodaj knjigu</a>
</div>

<div class="card shadow-sm mb-3">
    <div class="card-body">
        <label for="searchInput" class="form-label">Pretraga knjiga</label>
        <input type="text" id="searchInput" class="form-control" placeholder="Pretraži po naslovu, autoru ili kategoriji...">
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body table-responsive">
        <table class="table table-hover align-middle mb-0" id="booksTable">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Naslov</th>
                    <th>Autor</th>
                    <th>Godina</th>
                    <th>Kategorija</th>
                    <th>Status</th>
                    <th class="text-end">Akcije</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($books)): ?>
                    <tr><td colspan="7" class="text-center text-muted py-4">Nema unesenih knjiga.</td></tr>
                <?php else: ?>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td><?= (int) $book['id'] ?></td>
                            <td><?= htmlspecialchars($book['title']) ?></td>
                            <td><?= htmlspecialchars($book['author']) ?></td>
                            <td><?= (int) $book['published_year'] ?></td>
                            <td><?= htmlspecialchars($book['category_name']) ?></td>
                            <td>
                                <span class="badge text-bg-<?= $book['status'] === 'Dostupna' ? 'success' : 'secondary' ?>">
                                    <?= htmlspecialchars($book['status']) ?>
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="index.php?controller=book&action=edit&id=<?= (int) $book['id'] ?>" class="btn btn-sm btn-warning">Izmijeni</a>
                                <a href="index.php?controller=book&action=delete&id=<?= (int) $book['id'] ?>" class="btn btn-sm btn-danger confirm-delete">Obriši</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
