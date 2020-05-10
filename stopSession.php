<!--AUTHOR: Willi Hertel-->
<?php
//Logout
if(isset($_POST['updatePasswort'])){
    include_once 'includes.php';
    header(uriString('/updatePassword.php'));
}else if(isset($_POST['goToMainPage'])){
    include_once 'includes.php';
    header(uriString('/creatorPage.php'));
}else if(isset($_POST['goToSMainPage'])){
    include_once 'includes.php';
    header(uriString('/studentPage.php'));
}
else{
    session_start();
    session_destroy();
    include_once 'includes.php';
    echo "<h1>Abgemeldet</h1>";
}