<!--AUTHOR: Willi Hertel-->
<?php
//obligatory session start
session_start();
include_once 'pageHeader.php';
// if page not in index or register show page
if ($_SERVER['PHP_SELF'] != '/index.php' or $_SERVER['PHP_SELF'] != '/register.php')
    return;
// no session show error
elseif (!isset($_SESSION['User'])) {
    echo "Du bist nicht angemeldet<br>
          Bitte nutze folgende Seite um dich wieder anzumelden: <a href='index.php'>Startseite</a>" ;
    exit;
}