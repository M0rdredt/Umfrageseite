<!--AUTHOR: Willi Hertel-->
<?php
//db-Verbindungsdaten
$dbServername = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbProdName = "umfragen";
//DB-Verbindung
$connection = mysqli_connect($dbServername, $dbUser, $dbPassword, $dbProdName);