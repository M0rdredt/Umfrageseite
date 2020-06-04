<!--AUTHOR: Willi Hertel-->
<?php
//obligatory session start
session_start();
include_once 'pageHeader.php';
// if page not in index or register show page
if (!isset($_SESSION["User"])and !($_SERVER['PHP_SELF'] == "/index.php"
        xor $_SERVER['PHP_SELF'] == '/register.php'
        xor $_SERVER['PHP_SELF'] == '/loginUser.php'
        xor $_SERVER['PHP_SELF'] == "/registerUser.php")) {
    echo "Du bist nicht angemeldet<br>
          Bitte nutze folgende Seite um dich wieder anzumelden: <a href='index.php'>Startseite</a>" ;
    exit;
}