<?php
//if (isset($_SESSION['username'])) {
//if (!isset($_COOKIE['connection']) && isset($_SESSION['username']) && isset($_SESSION['remember'])) {
if (!isset($_COOKIE['connection']) && isset($_SESSION['username']) ) {
    echo "Bonjour 456" ;
    $cookieString = $_SESSION['username'];
    echo "cookieString : " . $cookieString ;
    $cookieDuration = 60 * 60 * 24 * 60; // 60 jours
    setcookie("connection", $cookieString, time() + $cookieDuration);
}

if (isset($_COOKIE['connection']) && is_string($_COOKIE['connection'])) {
    $username = $_COOKIE['connection'];
    echo "username : " . $username;

}
?>

