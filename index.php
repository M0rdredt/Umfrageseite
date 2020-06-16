<!--AUTHOR: Willi Hertel
index.php dient als Login für diverse Usertypen
-->

<?php
include_once 'includes.php';
?>
<h1>Login</h1>
Wenn du dich als Studierender an diesem System anmelden möchtest gebe bitte unter Username deine Matrikelnummer an.
<br>
Wenn du dich anmeldest um Fragebögen zu erzeugen melde dich bitte mit deinen Zugangsdaten an.
<br>
<br>
<form method="post" action="loginUser.php">
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

<?php
;

