<?php
session_start();

// Supprimer toutes les variables de session
$_SESSION = array();

// Détruire la session
session_destroy();

// Rediriger vers la page index.php
header("Location: http://localhost/TMAconnect/index.php");
exit();
?>