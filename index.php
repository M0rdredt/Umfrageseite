<!--AUTHOR: Willi Hertel
index.php file is also Login
-->

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

array("user_id" => array("1", "2"), "name" => array());
echo json_encode(DatabaseBaseObj::fetchTableDataBy2DimensionalArray("And","question", array("q_number" => array("1", "2"), "name" => array()), $connection));


