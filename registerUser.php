<?php
include_once "includes.php";

$password= null;
$username = null;
$password2 = null;

if (!isset($_POST["user"])) {
    echo "no username";
} else {
    $username = $_POST["user"];
}
if (!isset($_POST["password"])) {
    echo "no password provided";
} else {
    $password = $_POST["password"];
}
if (!isset($_POST["password2"])) {
    echo "no password provided";
} else {
    $password2 = $_POST["password2"];
}


try {
    Creator::registerCreator($username, $password, $password2, $connection);
    header(uriString("/creatorPage.php"));
} catch (WrongPasswordException $e) {
    include_once "register.php";
    echo "Passwort und Passwort bestätigung stimmen nicht überein";
} catch (InvalidArgumentException $e) {
    include_once "register.php";
    echo "Der Benutzer existiert bereits";
} catch (Exception $e){
    include_once "register.php";
    echo $e->getMessage()."<br>".$e->getTraceAsString();
}
