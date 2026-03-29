<h2 class="mb-3">Dodaj kategoriju</h2>
<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="index.php?controller=category&action=store" class="needs-validation" novalidate>
            <div class="mb-3">
                <label class="form-label">Naziv kategorije</label>
                <input type="text" name="name" class="form-control" required>
                <div class="invalid-feedback">Unesite naziv kategorije.</div>
            </div>
            <div class="mb-3">
                <label class="form-label">Opis</label>
                <textarea name="description" class="form-control" rows="4"></textarea>
            </div>
            <button class="btn btn-success">Sačuvaj</button>
            <a href="index.php?controller=category&action=index" class="btn btn-secondary">Nazad</a>
        </form>
    </div>
</div>
