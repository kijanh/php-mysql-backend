document.addEventListener('DOMContentLoaded', () => {
    const forms = document.querySelectorAll('.needs-validation');

    Array.from(forms).forEach((form) => {
        form.addEventListener('submit', (event) => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });

    document.querySelectorAll('.confirm-delete').forEach((button) => {
        button.addEventListener('click', (event) => {
            const confirmed = window.confirm('Da li ste sigurni da želite obrisati ovaj zapis?');
            if (!confirmed) {
                event.preventDefault();
            }
        });
    });

    const searchInput = document.getElementById('searchInput');
    const booksTable = document.getElementById('booksTable');

    if (searchInput && booksTable) {
        searchInput.addEventListener('keyup', () => {
            const filter = searchInput.value.toLowerCase();
            const rows = booksTable.querySelectorAll('tbody tr');

            rows.forEach((row) => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    }
});
