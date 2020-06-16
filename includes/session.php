<!--AUTHOR: Willi Hertel-->
<?php
//obligatorischer session start
session_start();
include_once 'pageHeader.php';
// wenn Seite nicht in inhdex, register, loginUser, registerUser und keine Session dann Fehler
if (!isset($_SESSION["User"])and !($_SERVER['PHP_SELF'] == "/index.php"
        xor $_SERVER['PHP_SELF'] == '/register.php'
        xor $_SERVER['PHP_SELF'] == '/loginUser.php'
        xor $_SERVER['PHP_SELF'] == "/registerUser.php")) {
    echo "Du bist nicht angemeldet<br>
          Bitte nutze folgende Seite um dich wieder anzumelden: <a href='index.php'>Startseite</a>" ;
    exit;
}