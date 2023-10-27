document.getElementById('formFiltre').addEventListener('submit', function (event) {
    event.preventDefault(); // Empêche la soumission par défaut du formulaire

    // Récupérez les valeurs des champs de filtre
    var select_domaine = document.getElementById('select_domaine').value;
    var select_etat = document.getElementById('select_etat').value;
    var num_dmd = document.getElementById('num-dmd').value;

    // Effectuez la requête AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../php/S-Filtre?select_domaine=' + select_domaine + '&select_etat=' + select_etat + '&num-dmd=' + num_dmd, true);
    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 400) {
            // La requête a réussi, vous pouvez mettre à jour le contenu du tableau ici
            document.getElementById('table').innerHTML = xhr.responseText; // Mettez à jour l'élément avec l'ID 'table'
        } else {
            // Une erreur s'est produite
            console.error(xhr);
        }
    };
    xhr.send();
});
