<!--AUTHOR: Willi Hertel-->
<!Doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Umfragetool</title>
</head>
<body>
<?php
//TODO: please do not delete this TODO everything that might be useful for every page should be contained within here
//PLEASE TEST EVERYTHING IF YOU ADD SOMETHING INTO THIS FILE BECAUSE OF UNFORESEEN CONSEQUENCES
//File should be used to get Header for page alternatively session.php can be used if you want header but not the rest
include_once  "DatabaseBaseObj.php";
include_once "MySqlException.php";
include_once "WrongPasswordException.php";
include_once "Creator.php";
include_once "Student.php";
include_once 'includes/session.php';
include_once 'includes/dbConnect.php';
include_once 'includes/locationStringConverter.php';
include_once 'includes/questionnaireSelectors.php';
