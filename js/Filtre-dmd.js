document.cookie = ""
document.addEventListener('DOMContentLoaded', function() {
    const tableDemandes = document.getElementById('tableDemandes');
    const filtres = document.querySelectorAll('.filtre');

    function filtrerDemandes() {
        const domaine = document.getElementById('domaine').value.toLowerCase();
        const etat = document.getElementById('etat').value.toLowerCase();
        const type = document.getElementById('type').value.toLowerCase();

        fetch('traitement.php')
            .then(response => response.json())
            .then(data => {
                const demandesFiltrees = data.filter(demande => 
                    demande.Domaine.toLowerCase().includes(domaine) &&
                    demande.Etat.toLowerCase().includes(etat) &&
                    demande.Type.toLowerCase().includes(type)
                );

                afficherDemandes(demandesFiltrees);
            });
    }

    function afficherDemandes(demandes) {
        tableDemandes.innerHTML = '';

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

    filtres.forEach(filtre => {
        filtre.addEventListener('keyup', filtrerDemandes);
    });

    filtrerDemandes();
});
