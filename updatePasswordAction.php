<!--AUTHOR: WILLI HERTEL-->
<?php
include_once 'includes.php';
//Code zum updaten des Passworts
$creator = $_SESSION['User'];
changePassword( $_POST['newPassword'], $_POST['newPasswordBest'], $creator, $connection);
function changePassword( $newPassword, $newPasswordBest, $username, $connection){
    if ($newPassword!=$newPasswordBest){
        header(uriString('/updatePassword.php'));
    }else{
        $newPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        echo  $newPassword;
        $sql = 'update creator 
                set password = ? 
                where user_id = ? ';
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $newPassword,$username );
        if (!mysqli_stmt_execute($stmt)) {
            include_once 'index.php';
            echo mysqli_error($connection);
        } else {
            //header(uriString("/creatorPage.php"));
        }
    }
}
include_once "EndOfPage.php";