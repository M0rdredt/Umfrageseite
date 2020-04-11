<!--AUTHOR: Willi Hertel-->
<?php
include_once 'includes.php';
//only test code
    echo $_SESSION['username'];
    if (isset($_GET['ID']))
        echo $_GET['ID'];
    else echo "nix";