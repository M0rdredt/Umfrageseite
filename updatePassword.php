<!--AUTHOR Willi Hertel-->

<?php
include_once 'includes.php';
//Form zum updaten des Passworts
?>
<form method="post" action="updatePasswordAction.php">
    <table>
        <tr>
            <td>
                neues Passwort:
            </td>
            <td>
                <label>
                    <input type="password" name="newPassword"  title="neues Passwort" required>
                </label>
            </td>
        </tr>
        <tr>
            <td>
                neues Passwort bestätigen:
            </td>
            <td>
                <label>
                    <input type="password" name="newPasswordBest"  title="neues Passwort bestätigen" required>
                </label>
            </td>
        </tr>
    </table>
    <input type="submit" name="setNewPassword" title="Neues Passwort setzen" value="Neues Passwort setzen">
</form>
<?php
include_once "EndOfPage.php";