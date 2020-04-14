<!--AUTHOR: Willi Hertel-->
<?php
//mainly html for registration
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
<form method="post" action="loginRegisterUser.php">
    <table>
        <tr>
            <td>
                <label>Username:</label>
            </td>
            <td>
                <label>
                    <input type="text" name="user">
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label>Password:</label>
            </td>
            <td>
                <label>
                    <input type="password" name="password">
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label>Password bestätigen:</label>
            </td>
            <td>
                <label>
                    <input type="password" name="passwordBest">
                </label>
            </td>
        </tr>
    </table>
    <br>
    <input type="submit" name="registerPage" value="Registrieren" title="Registrieren">
</form>
</body>
</html>