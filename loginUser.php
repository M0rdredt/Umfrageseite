<!--AUTHOR: Willi Hertel-->
<?php
//kümmert sich um den Login serverseitig und händelt diverse Fehlerfälle
include_once "includes.php";
include_once "Student.php";
include_once "Creator.php";
$username = "";
$password = "";

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
if (isset($_POST["loginStudent"])) {
    try {
        student_login($username, $connection);
        header(uriString("/studentPage.php"));
    } catch (Exception $e) {
        include_once "index.php";
        echo "Matrikelnummer " . $username . " nicht gefunden";
    }

}
if (isset($_POST["loginCreator"])) {
    try {
        creator_login($username, $password, $connection);
        header(uriString("/creatorPage.php"));
    } catch (WrongPasswordException $e) {
        include_once "index.php";
        echo "Falsches Passwort";
    } catch (InvalidArgumentException $e){
        include_once "index.php";
        echo "Username oder Passwort fehlt";
    } catch (Exception $e) {
        include_once "index.php";
        echo "Nutzer existiert noch nicht bitte registrieren";
    }

}
if (isset($_POST["register"])) {
    header(uriString('/register.php'));
    exit;
}
include_once "EndOfPage.php";
