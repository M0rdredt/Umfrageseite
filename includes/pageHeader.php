<!--AUTHOR: Willi Hertel-->
<?php
//Header if session exists: Login
    if (!isset($_SESSION['username'])){
        echo "<form action='../index.php'>
                <input type='submit' title='Login' value='Login'>
              </form>";
    }else{
        //or if no Session exists Logout
        echo "<form action='../stopSession.php'>
                <input type='submit' title='Abmelden' value='Abmelden'>
              </form>";
    }