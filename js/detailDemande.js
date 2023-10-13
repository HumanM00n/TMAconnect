// let afficherDetails = document.getElementById('menuNouvelDmd');

document.querySelectorAll('#monBouton').forEach(bouton => {
    bouton.addEventListener('click', function () {
        fetch('test-code2.php')
            .then(response => response.text())
            .then(data => {
                console.log(data);
            })
            .catch((error) => {
                console.error('Erreur :', error);
            });
        const row = this.parentElement.parentElement; // Récupère la ligne parente du bouton
        const detailsDemande = document.createElement('tr'); // Crée une nouvelle ligne pour les détails

        detailsDemande.innerHTML = '<td colspan="10">bonjour</td>';

        if (!row.classList.contains('details-visible')) {
            row.classList.add('details-visible');
            row.after(detailsDemande); // Ajoute les détails après la ligne de demande
        } else {
            row.classList.remove('details-visible');
            const detailsRow = row.nextElementSibling; // Récupère la ligne des détails
            if (detailsRow && detailsRow.classList.contains('afficherDetails')) {
                detailsRow.remove(); // Supprime les détails s'ils sont déjà visibles
            }
        }
    });
});
