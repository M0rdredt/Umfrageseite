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
        $_SESSION['COURSE'] = $row["ABBREVIATION"];
        $_SESSION['NAME'] = $row["NAME"];
        header(uriString("/studentPage.php"));
        }

}
//TODO: impl
function loginCreator($user, $pass, $conn){

}
//TODO: impl
function register($username, $password, $conn){

}
