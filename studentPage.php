<!--AUTHOR: Willi Hertel-->
<?php
//Student can get his questionnaires from here
include_once 'includes.php';
echo "<h1>Hallo ".$_SESSION['NAME']." aus Kurs ".$_SESSION['COURSE']. "</h1><br>"
    ."Dies sind deine Fragebögen:<br>";
echo getQuestionnaireTableByCourse($_SESSION['COURSE'], $connection);

