<!--AUTHOR: Willi Hertel-->
<?php
//mainly html for registration
include_once 'includes.php';
?>
<h1>Registrieren</h1>
<form method="post" action="registerUser.php">
    <table>
        <tr>
            <td>
                <label>Username:</label>
            </td>
            <td>
                <label>
                    <input type="text" name="user" required>
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label>Password:</label>
            </td>
            <td>
                <label>
                    <input type="password" name="password" required>
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label>Password bestätigen:</label>
            </td>
            <td>
                <label>
                    <input type="password" name="password2" required>
                </label>
            </td>
        </tr>
    </table>
    <br>
    <input type="submit" name="registerPage" value="Registrieren" title="Registrieren">
</form>
</body>
</html>