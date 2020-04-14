<!--AUTHOR: Willi Hertel-->
<?php
//Student can get his questionnaires from here
include_once 'includes.php';
echo "<h1>Hallo ".$_SESSION['name']." aus Kurs ".$_SESSION['course']. "</h1><br>"
    ."Dies sind deine Fragebögen:<br>";
echo getQuestionnaireTableByCourse($_SESSION['course'], $connection);

