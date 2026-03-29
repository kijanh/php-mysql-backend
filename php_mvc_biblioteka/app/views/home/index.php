<div class="p-5 mb-4 bg-body-tertiary rounded-3 shadow-sm">
    <div class="container-fluid py-2">
        <h1 class="display-6 fw-bold">Biblioteka knjiga</h1>
        <p class="col-md-9 fs-5">
            Ova MVC aplikacija omogućava upravljanje knjigama i kategorijama kroz unos, pregled, izmjenu i brisanje podataka.
        </p>
        <div class="d-flex gap-2 flex-wrap">
            <a href="index.php?controller=book&action=index" class="btn btn-primary btn-lg">Pregled knjiga</a>
            <a href="index.php?controller=category&action=index" class="btn btn-outline-secondary btn-lg">Pregled kategorija</a>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Ukupno knjiga</h5>
                <p class="display-6 mb-0"><?= (int) $booksCount ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Ukupno kategorija</h5>
                <p class="display-6 mb-0"><?= (int) $categoriesCount ?></p>
            </div>
        </div>
    </div>
</div>
