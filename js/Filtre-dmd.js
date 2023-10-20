// Efface tous les cookies
document.cookie = "";

// Attend que le contenu de la page soit chargé
document.addEventListener('DOMContentLoaded', function() {

    // Récupère la référence à la table d'affichage des demandes
    const tableDemandes = document.getElementById('tableDemandes');

    // Récupère toutes les éléments avec la classe 'filtre'
    const filtres = document.querySelectorAll('.filtre');

    // Cette fonction va filtrer les demandes en fonction des valeurs dans les champs de filtre
    function filtrerDemandes() {
        // Récupère les valeurs des champs de filtre
        const domaine = document.getElementById('domaine').value.toLowerCase();
        const etat = document.getElementById('etat').value.toLowerCase();
        const type = document.getElementById('type').value.toLowerCase();

        // Effectue une requête pour obtenir les données du serveur (traitement.php)
        fetch('traitement.php')
            .then(response => response.json()) // Transforme la réponse en JSON
            .then(data => {
                // Filtre les demandes en fonction des critères de filtre
                const demandesFiltrees = data.filter(demande => 
                    demande.Domaine.toLowerCase().includes(domaine) &&
                    demande.Etat.toLowerCase().includes(etat) &&
                    demande.Type.toLowerCase().includes(type)
                );

                // Affiche les demandes filtrées
                afficherDemandes(demandesFiltrees);
            });
    }

    // Cette fonction va afficher les demandes dans la table
    function afficherDemandes(demandes) {
        // Efface le contenu de la table
        tableDemandes.innerHTML = '';

        // Pour chaque demande, crée une nouvelle ligne et ajoute les informations
        demandes.forEach(demande => {
            const tr = document.createElement('tr');
            tr.innerHTML = `<td>${demande.IdDemande}</td>
                            <td>${demande.Domaine}</td>
                            <td>${demande.Libelle}</td>
                            <td>${demande.Qualif}</td>
                            <td>${demande.Date_Crea}</td>
                            <td>${demande.Etat}</td>`;
            tableDemandes.appendChild(tr);
        });
    }

    // Pour chaque élément de filtre, ajoute un écouteur d'événement sur l'événement 'keyup' (lorsqu'une touche est relâchée)
    filtres.forEach(filtre => {
        filtre.addEventListener('keyup', filtrerDemandes);
    });

    // Appelle la fonction de filtrage pour afficher les demandes au chargement initial
    filtrerDemandes();
});
