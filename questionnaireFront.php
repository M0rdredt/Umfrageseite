<?php
include_once 'includes.php';
if (!isset($_SESSION['username']))
    echo "Du bist nicht angemeldet<br>
          Bitte nutze folgende Seite um dich wieder anzumelden: <a href='index.php'>Startseite</a>";
else {
    echo $_SESSION['username'];
    if (isset($_GET['ID']))
        echo $_GET['ID'];
    else echo "nix";
}