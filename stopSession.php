<!--AUTHOR: Willi Hertel-->
<?php
//Logout
session_start();
session_destroy();
include_once 'includes.php';
echo "<h1>Abgemeldet</h1>";
