<!--AUTHOR: Willi Hertel-->
<?php
//Student bekommt seine Fragebögen hier
include_once 'includes.php';
if(($_SESSION["Role"] != "S")){
    //header(uriString("/index.php"));
} else {
    $student = $_SESSION["User"];

    echo "<h1>Hallo ".$student["NAME"]." aus Kurs ".$student["ABBREVIATION"]. "</h1><br>"
        ."Dies sind deine Fragebögen:<br>";
    echo getQuestionnaireTableByCourse($student["ABBREVIATION"], $connection);
}
include_once "EndOfPage.php";

