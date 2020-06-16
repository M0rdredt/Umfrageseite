<!--AUTHOR: Willi Hertel-->
<?php
//Header wenn session exitiert: Login
//Header wenn session exitiert und R = "C": Abmelden, Paswort, zur Hauptseite springen
//Header wenn session exitiert und R = "S": Abmelden, zur Hauptseite springen


    if (!isset($_SESSION["User"])){
        echo "<form action='../index.php'>
                 <input type='submit' name='login' title='Login' value='Login'>
              </form>";
    }else{
        if(isset($_SESSION["Role"]) ){
            if ($_SESSION["Role"] == "C"){
            echo "<form method='post' action='../stopSession.php'>
                <input type='submit' name='logout' title='Abmelden' value='Abmelden'>
                <input type='submit' name='updatePasswort' title='Passwort updaten' value='Passwort updaten'>
                <input type='submit' name='goToMainPage' title='Zur Creator-Hauptseite springen' value='Zur Creator-Hauptseite springen'>
              </form>";
            }
            elseif($_SESSION["Role"] == "S"){
                echo "<form method='post' action='../stopSession.php'>
                <input type='submit' name='logout' title='Abmelden' value='Abmelden'>
                <input type='submit' name='goToSMainPage' title='Zur Studenten-Hauptseite springen' value='Zur Studenten-Hauptseite springen'>
              </form>";
            }}
    }