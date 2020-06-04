<!--AUTHOR: Willi Hertel-->
<?php
//obligatory session start
session_start();
include_once 'pageHeader.php';
if ($_SERVER['PHP_SELF'] == "/index.php"){
    echo "index <br>";
}
if ($_SERVER['PHP_SELF'] == '/register.php'){
    echo "register <br>";
}
if($_SERVER['PHP_SELF'] != "/index.php" xor $_SERVER['PHP_SELF'] != '/register.php'){
    echo "not index or not register <br>";
}
// if page not in index or register show page
if (!isset($_SESSION["User"])and !($_SERVER['PHP_SELF'] == "/index.php"
        xor $_SERVER['PHP_SELF'] == '/register.php'
        xor $_SERVER['PHP_SELF'] == '/loginUser.php'
        xor $_SERVER['PHP_SELF'] == "/registerUser.php")) {
    echo "Du bist nicht angemeldet<br>
          Bitte nutze folgende Seite um dich wieder anzumelden: <a href='index.php'>Startseite</a>" ;
    exit;
}