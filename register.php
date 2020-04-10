<!--AUTHOR: Willi Hertel-->
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
<h1>Registrieren</h1>
<form method="post" action="loginRegisterUser.php" >
    <label>Username:
        <input type="text" name="user">
    </label>
    <br>
    <label>Password:
        <input type="password" name="password">
    </label>
    <br>
    <label>
        Password bestätigen
        <input type="password" name="passwordBest">
    </label>
    <br>
    <input type="submit" name="registerPage" value="Registrieren" title="Registrieren">
</form>
</body>
</html>