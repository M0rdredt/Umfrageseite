<!--AUTHOR: Willi Hertel-->
<?php
//functions for logon with students and creators and registration
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
        Student::loginStudent($username, $connection);
        header(uriString("/studentPage.php"));
    } catch (NoDataFoundException $e) {
        include_once "index.php";
        echo "Matrikelnummer " . $username . " nicht gefunden";
    }

}
if (isset($_POST["loginCreator"])) {
    try {
        Creator::loginCreator($username, $password, $connection);
        header(uriString("/creatorPage.php"));
    } catch (NoDataFoundException $e) {
        include_once "index.php";
        echo "User " . $username . " nicht gefunden";
    } catch (WrongPasswordException $e) {
        include_once "index.php";
        echo "Falsches Passwort";
    } catch (InvalidArgumentException $e){
        include_once "index.php";
        echo "Username oder Passwort fehlt";

    } catch (Exception $e) {
        include_once "index.php";
        echo $e -> getMessage();
    }

}
if (isset($_POST["register"])) {
    header(uriString('/register.php'));
    exit;
}
