<?php
include_once 'includes.php';
changePassword( $_POST['newPassword'], $_POST['newPasswordBest'], $_SESSION['username'], $connection);

function changePassword( $newPassword, $newPasswordBest, $username, $connection){
    if ($newPassword!=$newPasswordBest){
        header(uriString('updatePassword.php'));
        echo 'Neues Passwort und Bestätigung müssen übereinstimmen';
    }else{
        $newPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $sql = 'update creator 
                set password = ? 
                where user_id = ? ';
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $newPassword,$username );
        if (!mysqli_stmt_execute($stmt)) {
            include_once 'index.php';
            echo mysqli_error($connection);
        } else {
            header(uriString("/creatorPage.php"));
        }
    }
}