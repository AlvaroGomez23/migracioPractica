function confirmDelete(id, nom, email, button) {
    Swal.fire({
        title: "Confirmació",
        text: `Estas segur que vols eliminar el següent usuari: ${nom} (${email})`,
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancel·lar",
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, elimina'l!"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(deleteUserUrl, {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: `id=${id}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire("Eliminat!", `L'usuari ${nom} s'ha eliminat correctament`, "success").then(() => {
                        const row = button.closest('tr');
                        row.remove();
                    });
                } else {
                    Swal.fire("Error", "Hi ha hagut un problema al eliminar l'usuari", "error");
                }
            })
            .catch(() => {
                Swal.fire("Error", "Hi ha hagut un problema al eliminar l'usuari", "error");
            });
        }
    });
}
