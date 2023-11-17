<?php include_once('../includes/connexion.inc.php') ?>

/* -----------------------------------------
        CREER UNE FONCTION SCRATCH      |
------------------------------------------*/

<br>

<?php

// Créer une fonction from scratch qui s'appelle quiEstLeMeilleurProf(). Elle doit retourner Le prof de programmation Web

//CORRIGER AVEC CHATGPT
function quiEstLeMeilleurProf()
{
    return "Qui est le meilleur prof ? ";
}

// Utilisation de la fonction 
$message = 'Le prof de programmation Web';
echo $message;
?>

<br> 

<?php
// Créer une fonction from scratch qui s'appelle jeRetourneMonArgument(). Exemple : Arg = "abc" ==> Return abc Arg = 123 ==> Return 123

//CORRIGER AVEC CHATGPT
function JeRetourneMonArgument($argument)
{
    return $argument;
}

// Utilisation de la fonction 
$result1 = JeRetourneMonArgument("abc");
$result2 = JeRetourneMonArgument(123);

echo $result1; // On affiche "abc"
echo $result2; // On affiche 123

?>

<br> 

/* -----------------------------------------------------
    CREER UNE FONCTION SCRATCH + CONCATENATION STRING  |
------------------------------------------------------*/

<br>

<?php
//Créer une fonction from scratch qui s'appelle concatenation(). Elle prendra deux arguments de type string. 
//Elle devra retourner la concatenation des deux. 
//Exemple : argument 1 = Antoine Argument 2 = Griezmann; Resultat : AntoineGriezmann

function concatenation($argument)
{
    return $argument;
}

// Utilisation de la fonction
$argument1 = concatenation("Antoine");
$argument2 = concatenation("Griezmann");

echo $argument1 . $argument2;

?>

<br> 

<?php 
//Créer une fonction from scratch qui s'appelle concatenationAvecEspace(). 
//Elle prendra deux arguments de type string. 
//Elle devra retourner la concatenation des deux. Exemple : argument 1 = Ngolo Argument 2 = Kante; Resultat : Ngolo Kante

function concatenationAvecEspace($argument) {
    return $argument;
}

// Utilisation de la fonction
$argument1 = concatenationAvecEspace("Ngolo ");
$argument2 = concatenationAvecEspace("Kante");

echo $argument1 .$argument2;

?>

<br> 

/* ---------------------------------------------------
    CREER UNE FONCTION SCRATCH + CONCATENATION INT    |
----------------------------------------------------*/
<br> 

<?php
/* --------------------------------
            ADDITION              |
---------------------------------*/

//Créer une fonction from scratch qui s'appelle somme(). 
//Elle prendra deux arguments de type int. 
//Elle devra retourner la somme des deux. Exemple : argument 1 = 5 Argument 2 = 5 ; Resultat : 10

//CORRIGER AVEC CHATGPT
function somme($addition) {
    return $addition;
}

// Utilisation de la fonction

$chiffre1 = somme(5);
$chriffre2 = somme(5);

$resultat = $chiffre1 + $chriffre2;

echo $resultat;

?>

<br> 

<?php 

/* --------------------------------
            SOUSTRACTION          |
---------------------------------*/
//Créer une fonction from scratch qui s'appelle soustraction(). 
//Elle prendra deux arguments de type int. 
//Elle devra retourner la soustraction des deux. Exemple : argument 1 = 5 Argument 2 = 5 ; Resultat : 0

function soustraction($soustraction) {
    return $soustraction;
}

// Utilisation de la fonction 
$chiffre1 = soustraction(5);
$chiffre2 = soustraction(5);

$resultat = $chiffre1 - $chiffre2;

echo $resultat;
?>

<?php 

/* ---------------------------------
            MULTIPLACTION          |
----------------------------------*/
//Créer une fonction from scratch qui s'appelle multiplication(). Elle prendra deux arguments de type int. 
//Elle devra retourner la multiplication des deux. 
//Exemple : argument 1 = 5 Argument 2 = 5 ; Resultat : 25

function multiplication($multiplication) {
    return $multiplication;
}
//Utilisation de la fonction 

$chiffre1 = multiplication(5);
$chiffre2 = multiplication(5);

$resultat = $chiffre1 * $chiffre2;

echo $resultat;

?>

<?php 
/* ---------------------------------
              BOOLEAN              |
----------------------------------*/

//Créer une fonction from scratch qui s'appelle estIlMajeure(). Elle prendra un argument de type int. 
//Elle devra retourner un boolean. 
//Si age >= 18 elle doit retourner true si age < 18 elle doit retourner false Exemple : age = 5 ==> false age = 34 ==> true

//CORRIGER AVEC CHATGPT
function estIlMajeure($age) {
    return ($age >= 18);
}

// Utilisation de la fonction 

$resultat1 = estIlMajeure(5);
$resultat2 = estIlMajeure(34);

var_dump($resultat1); // Affiche bool(false)
var_dump($resultat2); // Affiche bool(true)
?>

<br> 

<?php 

/* --------------------------------
            COMPARAISON           |
---------------------------------*/

//Créer une fonction from scratch qui s'appelle plusGrand(). 
//Elle prendra deux arguments de type int. 
//Elle devra retourner le plus grand des deux.

//CORRIGER AVEC CHATGPT
    function plusGrand($nombre1, $nombre2) { 
        return max($nombre1, $nombre2); // Appeler la fonction avec différentes paires de nombres.
    }

    // Utilisation de la fonction 

    $resultat1 = plusGrand(5, 10); // Retourne 10
    $resultat2 = plusGrand(20, 15); // Retourne 20

    echo $resultat1; // Affiche 10
    echo $resultat2; // Affiche 20

    // /!\ La fonction 'max($nombre1, $nombre2)' est utilisé pour retourner les plus grands des deux nombres.
?>

<br> 

<?php 

// Créer une fonction from scratch qui s'appelle plusPetit(). 
// Elle prendra deux arguments de type int. Elle devra retourner le plus petit des deux.
function plusPetit($nombre1, $nombre2) {
    return min($nombre1, $nombre2);
}

    // Utilisation de la fonction 
    $resultat1 = plusPetit(11,66); // Retourne 11.03
    $resultat2 = plusPetit(24,33); // Retourne 2000000

    echo $resultat1;
    echo $resultat2;

?>

<br> 

<?php 

// Créer une fonction from scratch qui s'appelle plusPetit(). 
// Elle prendra trois arguments de type int. 
// Elle devra retourner le plus petit des trois.

function plusPetit2($nombre1, $nombre2, $nombre3) {
    return max($nombre1, $nombre2, $nombre3);
}
    // Utilisation de la fonction 
    $resultat1 = plusPetit2(8,9,10);

    echo $resultat1; 
?>

<br> 

/* --------------------------------
     STRUCTURE CONDITIONNELLES    |
---------------------------------*/

<?php 

// Créer une fonction from scratch qui s'appelle premierElementTableau(). 
// Elle prendra un argument de type array. 
// Elle devra retourner le premier élement du tableau. Si l'array est vide, il faudra retourner null;

function premierElementTableau($array) {
    if (empty($array)) {
        return null;
    } else {
        return reset($array);
    }
}

// Exemples d'utilisation
$array1 = array(1, 2, 3, 4, 5);
$array2 = array();

$resultat1 = premierElementTableau($array1); // Retourne 1
$resultat2 = premierElementTableau($array2); // Retourne null

echo $resultat1; // Affiche 1
echo $resultat2; // Affiche (rien, car null n'est pas affichable directement)
?>

<br>

<?php 

// Créer une fonction from scratch qui s'appelle dernierElementTableau(). 
// Elle prendra un argument de type array. 
// Elle devra retourner le dernier élement du tableau. Si l'array est vide, il faudra retourner null;

function dernierElementTableau($array) {
    if (empty($array)) {
        return null;
    } else {
        return end($array);
    }
}

// Exemples d'utilisation
$array1 = array(1, 2, 3, 4, 5);
$array2 = array();

$resultat1 = dernierElementTableau($array1); // Retourne 5
$resultat2 = dernierElementTableau($array2); // Retourne null

echo $resultat1; // Affiche 5
echo $resultat2; // Affiche (rien, car null n'est pas affichable directement)
?>

<br>

<?php 

// Créer une fonction from scratch qui s'appelle plusGrand(). 
// Elle prendra un argument de type array. 
// Elle devra retourner le plus grand des élements présent dans l'array. Si l'array est vide, il faudra retourner null;

 function plusGrand2($array) {
    if (empty($array)) {
        return 'null';
    } else {
        return max($array);
    }
}

    //Utilisationde la fonction 
    $array1 = array(24, 56, 99, 504, 101);

    $resultat1 = plusGrand2($array1); 

    echo $resultat1; // On affiche 504
?>

<br>

<?php 
//Créer une fonction from scratch qui s'appelle plusPetit(). 
// Elle prendra un argument de type array. 
// Elle devra retourner le plus petit des élements présent dans l'array. Si l'array est vide, il faudra retourner null;

function plusPetit1($array) {
    if (empty($array)) {
        echo 'null';
    } else {
        return min($array);
    }   
}

    // Utilisationde la fonction 
    $array = array(44, 58, -2, 72, 26);

    $resultat1 = plusPetit1($array);
    
    echo $resultat1; // On affiche -2
?>

<br>

<?php 
// Créer une fonction from scratch qui s'appelle verificationPassword(). 
// Elle prendra un argument de type string. 
// Elle devra retourner un boolean qui vaut true si le password fait au moins 8 caractères et false si moins.

function verificationPassword($argument) {
    if (strlen($argument) >= 8) { //strlen permet de compter le nombre de caractere dans une chaine de caracteres
        return true;
    } elseif (strlen($argument) < 8) {
        return false;
    }
}
    // Utilisation de la fonction 

    $argument = ('270503Mr');
    $resultat1 = verificationPassword($argument);

    echo $resultat1;

?>

<br>

<?php
     // AUTRE MANIERE DE LA PART DE CHAGPT
    function verificationPasswordGPT($password) {
        return strlen($password) >= 8;
}

    // Utilisation de la fonction
    $motDePasse  = '270503Mr';
    $resultat = verificationPasswordGPT($motDePasse);

    // Affichage du résultat
    echo $resultat ? 'Mot de passe valide' : 'Mot de passe invalide ';
?>




<br>

<?php 
// Créer une fonction from scratch qui s'appelle verificationPassword(). 
// Elle prendra un argument de type string. 
// Elle devra retourner un boolean qui vaut true si le password respecte les règles suivantes :

    // function verificationPassword2($passVerify) {
    //     if (password_verify($passVerify)):bool 
    //         { return true; 
    //     } else { 
    //         return false; }
    // }

    // // Utilisation de la fonction
    // $passVerify = '270503Mr';
    // $resultat = verificationPassword($passVerify);

    // echo $resultat ? 'Mot de passe valide': 'Mot de passe invalide';

?>

<?php 
    //CORRECTION CHATGPT
function verificationPassword2($password) {
    // Vérifie la longueur du mot de passe
    $longueurValide = strlen($password) >= 8;

    // Vérifie la présence d'au moins un chiffre
    $contientChiffre = preg_match('/[0-9]/', $password) === 1;

    // Vérifie la présence d'au moins une majuscule et une minuscule
    $contientMajuscule = preg_match('/[A-Z]/', $password) === 1;
    $contientMinuscule = preg_match('/[a-z]/', $password) === 1;

    // Retourne true si toutes les conditions sont satisfaites, sinon false
    return $longueurValide && $contientChiffre && $contientMajuscule && $contientMinuscule;
}

// Utilisation de la fonction
$motDePasse = 'Abcd1234';
$resultat = verificationPassword2($motDePasse);

// Affichage du résultat
echo $resultat ? 'Mot de passe valide' : 'Mot de passe invalide'; 
?>

<br>
<br>

<?php 
// Créer une fonction from scratch qui s'appelle capital(). 
// Elle prendra un argument de type string. 
// Elle devra retourner le nom de la capitale des pays suivants :

    function capital(string $pays): string {
        $paysetcapital = [
            'France' => 'Paris',
            'Allemangne' => 'Berlin',
            'Italie' => 'Rome',
            'Maroc' => 'Rabat',
            'Espagne' => 'Madrid',
            'Portugal' => 'Lisbonne',
            'Angleterre' => 'Londres',
        ];

        return $paysetcapital[$pays] ?? 'Inconnu';
    }

    echo capital('France'); echo '<br>';
    echo capital('Angleterre');
?>

<br>

<?php 
// Créer une fonction from scratch qui s'appelle listHTML(). Elle prendra deux arguments :
// Un string représentant le nom de la liste
// Un array représentant les élements de cette liste
// Elle devra retourner une liste HTML. Chaque element de cette liste viendra du tableau passé en paramètre.

// Exemple : Paramètre : Titre : Capitale Liste : ["Paris", "Berlin", "Moscou"] Résultat : <h3>Capitale</h3><ul><li>Paris</li><li>Berlin</li><li>Moscou</li></ul>

//Comme vous pouvez le voir il n'y a pas d'espace ni de retour à la ligne entre les élements de la liste. Pas d'espace non plus entre le titre et la liste.

//Si le titre est null et vide il faut que la fonction retourne null. Si l'array est vide, il faut que la fonction retourne null.

function listHTML(array $elements) {
    // Vérifie si le paramètre est un tableau 
    if (!is_array($elements)) { 
        return '<p>Erreur : Le paramètre doit être un tableau</p>';
    }

    // Commence la liste HTML
    $listHTML = '<ul>';

    // Ajoute chaque élément du tableau à la liste HTML
    foreach ($elements as $element) {
        $listHTML .= '<li>' . htmlspecialchars($element) . '</li>'; // Échappe les caractères spéciaux et prévient les attaques XSS.
    }

    // Termine la liste HTML 
    $listHTML .= '</ul>';

    // Retourne la liste générée
    return $listHTML;
}

// Définition du tableau $paysetcapital
$paysetcapital = [
    'France' => 'Paris',
    'Allemagne' => 'Berlin',
    'Italie' => 'Rome',
    'Maroc' => 'Rabat',
    'Espagne' => 'Madrid',
    'Portugal' => 'Lisbonne',
    'Angleterre' => 'Londres',
];

// Exemple d'utilisation avec le tableau $paysetcapital
$listeGeneree = listHTML($paysetcapital);

// Affiche la liste générée
echo $listeGeneree;
?>

<br>

