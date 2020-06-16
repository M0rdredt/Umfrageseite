<!--AUTHOR: Willi Hertel-->
<!Doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Umfragetool</title>
</head>
<body>
<?php
//diverse includes die überall obligatorisch oder zumindest nützlich sind
include_once  "DatabaseBaseObj.php";
include_once "MySqlException.php";
include_once "WrongPasswordException.php";
include_once "Creator.php";
include_once "Student.php";
include_once 'includes/session.php';
include_once 'includes/dbConnect.php';
include_once 'includes/locationStringConverter.php';
include_once 'includes/questionnaireSelectors.php';
