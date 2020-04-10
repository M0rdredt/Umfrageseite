<?php
include_once 'includes.php';
?>
<!Doctype html>
<html>
<header>
    <meta charset="UTF-8">
    <title>Umfragetool</title>
</header>
<body>
<h1>Login</h1>
Wenn du dich als Studierender an diesem System anmelden möchtest gebe bitte unter Username deine Matrikelnummer an.
<br>
Wenn du dich anmeldest um Fragebögen zu erzeugen melde dich bitte mit deinen Zugangsdaten an.
<br>
<br>
<form action="stopSession.php">
    <input type="submit" name="destroy" value="abmelden" title="abmelden">
</form>
<form method="post" action="loginRegisterUser.php">
    <label>Username:
        <input type="text" name="user"></label>
    <label>Password:
        <input type="password" name="password"></label>
    <br>
    <input type="submit" name="loginStudent" value="Login für Studenten" title="Login als Student">
    <input type="submit" name="loginCreator" value="Login für Creator"  title="Login als Creator">
    <br>
    <input type="submit" name="register" value="Registrieren" title="Registrieren">
</form>
</body>
</html>
