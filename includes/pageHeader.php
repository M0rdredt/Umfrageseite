<!--AUTHOR: Willi Hertel-->
<?php
//Header if session exists: Login

    if (!isset($_SESSION["User"])){
        echo "<form action='../index.php'>
                 <input type='submit' name='login' title='Login' value='Login'>
              </form>";
    }else{
        if($_SESSION["User"] instanceof Creator){
            echo "<form method='post' action='../stopSession.php'>
                <input type='submit' name='logout' title='Abmelden' value='Abmelden'>
                <input type='submit' name='updatePasswort' title='Passwort updaten' value='Passwort updaten'>
              </form>";
        }elseif ($_SESSION["User"] instanceof Student){
            //or if no Session exists Logout
            echo "<form method='post' action='../stopSession.php'>
                <input type='submit' name='logout' title='Abmelden' value='Abmelden'>
              </form>";
        }else
            echo "asdhfjasldujfhj";
    }