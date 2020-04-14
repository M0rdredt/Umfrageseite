<?php
include_once 'includes.php';
?>
<form method="post" action="updatePasswordAction.php">
    <table>
        <tr>
            <td>
                altes Passwort:
            </td>
            <td>
                <label>
                    <input type="password" name="oldPassword"  title="altes Passwort">
                </label>
            </td>
        </tr>
        <tr>
            <td>
                neues Passwort:
            </td>
            <td>
                <label>
                    <input type="password" name="newPassword"  title="neues Passwort">
                </label>
            </td>
        </tr>
        <tr>
            <td>
                neues Passwort bestätigen:
            </td>
            <td>
                <label>
                    <input type="password" name="newPasswordBest"  title="neues Passwort bestätigen">
                </label>
            </td>
        </tr>
    </table>
    <input type="submit" name="setNewPassword" title="Neues Passwort setzen" value="Neues Passwort setzen">
</form>
