// JavaScript pour la boîte de dialogue modale
var confirmationModal = document.getElementById("confirmationModal");
var confirmDeleteBtn = document.getElementById("confirmDeleteBtn");
var cancelDeleteBtn = document.getElementById("cancelDeleteBtn");

function showConfirmationModal(idUtilisateur) {
    confirmationModal.style.display = "block";

    confirmDeleteBtn.onclick = function () {
        deleteUtilisateur(idUtilisateur);
        confirmationModal.style.display = "none";
    };

    cancelDeleteBtn.onclick = function () {
        confirmationModal.style.display = "none";
    };
}

function deleteUtilisateur(idUtilisateur) {
    // Effectuer la suppression en appelant supprimer.php
    window.location.href = "supprimer.php?id=" + idUtilisateur;
}
