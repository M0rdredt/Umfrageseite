<!--AUTHOR: Willi Hertel-->
<?php
//functions for logon with students and creators and registration
include_once 'includes.php';
$username = "";
$password = "";

if (!isset($_POST["user"]))
    echo "no username";
else {
    $username = $_POST["user"];
    //echo $username;
}
if (!isset($_POST["password"]))
    echo "no password provided";
else{
    $password = $_POST["password"];
    //echo $password;
}
if (isset($_POST["loginStudent"]))
    loginStudent($username, $connection);
elseif (isset($_POST["loginCreator"]))
    loginCreator($username, $password, $connection);
elseif (isset($_POST["registerPage"]))
    if($password != $_POST["passwordBest"])
        echo "Bitte überprüfe deine Passwörter. <br> Diese stimmen nicht überein.";
    else
        register($username, $password, $connection);
elseif (isset($_POST["register"])) {
    header(uriString('/register.php'));
    exit;
} else
    echo "Internal Error while login in";

//function for login in Student
function loginStudent($username, $conn){
    //echo "Test";
    $sql = "Select * 
            from student 
            where student_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    if ($row == null){
        include_once 'index.php';
        echo "Matrikelnummer: ". $username. " ist unbekannt!";
    } else{
        $_SESSION['username'] = $row["STUDENT_ID"];
        $_SESSION['course'] = $row["ABBREVIATION"];
        $_SESSION['name'] = $row["NAME"];
        $_SESSION['role'] = 'S';
        header(uriString("/studentPage.php"));
        }

}
//TODO: impl
function loginCreator($user, $pass, $conn){
    $sql = "Select * 
            from creator
            where user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    if($row == null){
        include_once 'index.php';
        echo $user. ' ist unbekannt!';
        return;
    }elseif (!password_verify($pass, $row['PASSWORD'])){
        include_once 'index.php';
        echo 'Falsches Passwort';
    }else{
        $_SESSION['username'] = $user;
        $_SESSION['role'] = 'C';
        header(uriString("/creatorPage.php"));
    }
}
//TODO: impl
function register($username, $password, $conn){
    $password = password_hash($password, PASSWORD_BCRYPT);
    $sql = "Select * 
            from creator
            where user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    if($row != null){
        include_once 'register.php';
        echo "Benutzername existiert bereits!";
    }else{
        $sql = "Insert into creator values (?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $username, $password);
        if (!mysqli_stmt_execute($stmt)) {
            include_once 'index.php';
            echo mysqli_error($conn);
        } else {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = 'C';
            header(uriString("/creatorPage.php"));
        }
    }
}
