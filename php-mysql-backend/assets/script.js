// assets/script.js

function enableBootstrapValidation(formId) {
  const form = document.getElementById(formId);
  if (!form) return;

  form.addEventListener("submit", (e) => {
    if (!form.checkValidity()) {
      e.preventDefault();
      e.stopPropagation();
    }
    form.classList.add("was-validated");
  });
}

enableBootstrapValidation("createForm");
enableBootstrapValidation("editForm");

// Fill edit modal
document.querySelectorAll(".btn-edit").forEach(btn => {
  btn.addEventListener("click", () => {
    document.getElementById("editId").value = btn.dataset.id;
    document.getElementById("editIme").value = btn.dataset.ime;
    document.getElementById("editPrezime").value = btn.dataset.prezime;
    document.getElementById("editEmail").value = btn.dataset.email;

    // reset validation state
    const f = document.getElementById("editForm");
    f.classList.remove("was-validated");
  });
});

// SweetAlert delete confirm
document.querySelectorAll(".btn-delete").forEach(btn => {
  btn.addEventListener("click", async () => {
    const id = btn.dataset.id;

    const res = await Swal.fire({
      title: "Obrisati korisnika?",
      text: "Ova akcija se ne može vratiti.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Da, obriši",
      cancelButtonText: "Otkaži",
    });

    if (res.isConfirmed) {
      document.getElementById("deleteId").value = id;
      document.getElementById("deleteForm").submit();
    }
  });
});

// Simple search filter (bonus)
const searchInput = document.getElementById("searchInput");
const table = document.getElementById("usersTable");
const countLabel = document.getElementById("countLabel");

if (searchInput && table) {
  searchInput.addEventListener("input", () => {
    const q = searchInput.value.toLowerCase().trim();
    let visible = 0;

    table.querySelectorAll("tbody tr").forEach(tr => {
      const text = tr.innerText.toLowerCase();
      const show = text.includes(q);
      tr.style.display = show ? "" : "none";
      if (show) visible++;
    });

    if (countLabel) countLabel.textContent = String(visible);
  });
}