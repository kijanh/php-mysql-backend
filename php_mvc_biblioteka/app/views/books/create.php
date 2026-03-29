<h2 class="mb-3">Dodaj knjigu</h2>
<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="index.php?controller=book&action=store" class="needs-validation" novalidate>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Naslov</label>
                    <input type="text" name="title" class="form-control" required>
                    <div class="invalid-feedback">Unesite naslov knjige.</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Autor</label>
                    <input type="text" name="author" class="form-control" required>
                    <div class="invalid-feedback">Unesite autora.</div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Godina izdanja</label>
                    <input type="number" name="published_year" class="form-control" min="1900" max="2099" required>
                    <div class="invalid-feedback">Unesite godinu izdanja.</div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Kategorija</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">Odaberite kategoriju</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= (int) $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">Odaberite kategoriju.</div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="Dostupna">Dostupna</option>
                        <option value="Posuđena">Posuđena</option>
                    </select>
                </div>
            </div>
            <div class="mt-4">
                <button class="btn btn-success">Sačuvaj</button>
                <a href="index.php?controller=book&action=index" class="btn btn-secondary">Nazad</a>
            </div>
        </form>
    </div>
</div>
