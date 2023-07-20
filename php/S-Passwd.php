<?php
if(isset($_POST['subpassword']))
{
    $o_password = $_POST['o_password'];
    $n_password = $_POST['n_password'];
    $c_password = $_POST['c_password'];

    $o_password = md5($o_password);

    $db = new mysqli('localhost:3308', 'root', 'XVsikn92', 'form');

    if ($db->connect_errno) {
        echo 'Erreur de connexion à la base de données : ' . $db->connect_error;
        exit;
    }

    $pseudo = $db->real_escape_string($_POST['pseudo']);
    $o_password = $db->real_escape_string($o_password);

    $query = "SELECT * FROM utilisateur WHERE username='$pseudo' AND password='$o_password'";
    $result = $db->query($query);

    if (!$result) {
        echo 'Erreur lors de l\'exécution de la requête : ' . $db->error;
        exit;
    }

    $rows = $result->num_rows;

    if(empty($o_password))
    {
        echo "Veuillez saisir votre ancien mot de passe";  
    } else if ($n_password != $c_password) {
        echo "Vos nouveaux mots de passe sont différents";
    } else if ($rows == 0) {
        echo "L'ancien mot de passe est incorrect !";
    }

    $result->close();
    $db->close();
}
?>