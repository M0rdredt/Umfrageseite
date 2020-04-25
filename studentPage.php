<!--AUTHOR: Willi Hertel-->
<?php
//Student can get his questionnaires from here
include_once "Student.php";
include_once 'includes.php';
if(!(isset($_SESSION["User"]) or $_SESSION["User"] instanceof Student)){
    header(uriString("/index.php"));
} else {
    $user = $_SESSION["User"];

    echo "<h1>Hallo ".$user->getName()." aus Kurs ".$user->getCourse(). "</h1><br>"
        ."Dies sind deine Fragebögen:<br>";
    echo getQuestionnaireTableByCourse($user->getCourse(), $connection);
}


