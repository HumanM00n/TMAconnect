document.querySelectorAll('.afficherDetails').forEach(bouton => {
    bouton.addEventListener('click', function () {
        const row = this.parentElement.parentElement; // Récupère la ligne parente de l'émoticône
        const detailsDemande = row.nextElementSibling;

        // Vérifiez si les détails sont déjà visibles
        if (detailsDemande.style.display === 'none') {
            detailsDemande.style.display = 'table-row'; // Affiche la ligne des détails

            // Faites défiler vers le bas jusqu'à la section 'menuNouvelDmd'
            document.getElementById('menuNouvelDmd').scrollIntoView({ behavior: 'smooth' });
        } else {
            detailsDemande.style.display = 'none'; // Cache la ligne des détails
        }
    });
});

