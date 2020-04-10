<!--AUTHOR: Willi Hertel-->
<?php
include_once 'includes.php';
echo "<h1>Hallo ".$_SESSION['NAME']." aus Kurs ".$_SESSION['COURSE']. "</h1><br>"
    ."Dies sind deine Fragebögen:<br>";
echo getQuestionnaireListByCourse($_SESSION['COURSE'], $connection);

