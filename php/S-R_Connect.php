<?php
function activite()
{
    if (isset($_SESSION['lifetime']) && isset($_SESSION['activite']) && ($_SESSION['lifetime'] + $_SESSION['activite'] > time())) {
        $_SESSION['activite'] = time(); // On met à jour l'heure de la dernière activité utilisateur
    } else {
        session_unset(); //On supprime les données de session 
        session_destroy(); // On détruit la session 
    }
}

activite();
?>