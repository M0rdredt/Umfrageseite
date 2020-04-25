<!--AUTHOR: Willi Hertel-->
<?php
//db-Connection
include_once "DatabaseController.php";
$DbController = new DatabaseController();
$connection = $DbController->getProdConnection();
