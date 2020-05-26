<!--AUTHOR: Willi Hertel-->
<?php
//Student can get his questionnaires from here
include_once 'includes.php';
if(($_SESSION["Role"] != "S")){
    echo json_encode($_SESSION);
    //header(uriString("/index.php"));
} else {
    $student = $_SESSION["User"];

    echo "<h1>Hallo ".$student["NAME"]." aus Kurs ".$student["ABBREVIATION"]. "</h1><br>"
        ."Dies sind deine Fragebögen:<br>";
    echo getQuestionnaireTableByCourse($student["ABBREVIATION"], $connection);
}


