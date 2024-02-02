document.getElementById('formFiltre').addEventListener('submit', function (event) {
    event.preventDefault(); // Empêche la soumission par défaut du formulaire

    // Récupérez les valeurs des champs de filtre
    var select_domaine = document.getElementById('select_domaine').value;
    var select_etat = document.getElementById('select_etat').value;
    var num_dmd = document.getElementById('num_dmd').value;
    var lib_dmd = document.getElementById('lib_dmd').value;

    // On utilise console.log pour afficher les valeurs
    console.log('select_domaine:', select_domaine);
    console.log('select_etat:', select_etat);
    console.log('num_dmd:', num_dmd)
    console.log('lib_dmd:', lib_dmd)


    // Effectuez la requête AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../php/S-Filtre.php', true); // Modification de la méthode ici
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Ajout de l'en-tête

    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 400) {
            // La requête a réussi, vous pouvez mettre à jour le contenu du tableau ici
            document.getElementById('table').innerHTML = xhr.responseText; // Mettez à jour l'élément avec l'ID 'table'
        } else {
            // Une erreur s'est produite
            console.error(xhr);
        }
    };

    // Envoyez les données du formulaire avec la requête POST
    xhr.send('select_domaine=' + select_domaine + '&select_etat=' + select_etat + '&num_dmd=' + num_dmd + '&lib_dmd=' + lib_dmd);

});

// Script AJAX pour filtrer en temps réel les valeurs renseignés dans le filtre 

$(document).ready(function () {
    $('#formFiltre').submit(function (event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: 'test-code4.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#table').html(data);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    $('#num_dmd').on('input', function () {
        var numDmdValue = $(this).val();

        $.post('test-code4.php', { num_dmd: numDmdValue }, function (data) {
            $('#table').html(data);
        });
    });
});


