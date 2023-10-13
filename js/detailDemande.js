document.querySelectorAll('#monBouton').forEach(bouton => {
    bouton.addEventListener('click', function () {
        let id_demande = this.dataset.id
        console.log(id_demande);
        let url =`test-code2.php?id_demande=${encodeURIComponent(id_demande)}`;

        fetch(url)
            .then(response => response.text())
            .then(data => {
                const row = this.parentElement.parentElement; // Récupère la ligne parente du bouton
                const detailsDemande = document.createElement('td'); // Crée une nouvelle ligne pour les détails

                detailsDemande.innerHTML = data;

                if (!row.classList.contains('details-visible')) {
                    // row.classList.add('details-visible');
                    row.after(detailsDemande); // Ajoute les détails après la ligne de demande
                } else {
                    // row.classList.remove('details-visible');
                    const detailsRow = row.nextElementSibling; // Récupère la ligne des détails
                    if (detailsRow && detailsRow.classList.contains('afficherDetails')) {
                        detailsRow.remove(); // Supprime les détails s'ils sont déjà visibles
                    }
                }
            })
            .catch((error) => {
                console.error('Erreur :', error);
            });

    });
});
