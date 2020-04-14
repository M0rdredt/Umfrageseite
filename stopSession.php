<!--AUTHOR: Willi Hertel-->
<?php
//Logout
if(!isset($_POST['logout'])){
    include_once 'includes.php';
    header(uriString('/updatePassword.php'));
}else{
    session_start();
    session_destroy();
    include_once 'includes.php';
    echo "<h1>Abgemeldet</h1>";
}