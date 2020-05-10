<!--AUTHOR: David Horseling -->
<?php
include_once "includes.php";
$course=null;

if (!isset($_POST["STUDENT_ID"])) {
    echo "No student id";
} else {
    $STUDENT_ID = $_POST["STUDENT_ID"];
}

if (!isset($_POST["NAME"])) {
    echo "No name";
} else {
    $NAME = $_POST["NAME"];
}

if (!isset($_POST["ABBREVIATION"])) {
    echo "No abbreviation";
} else {
    $ABBREVIATION = $_POST["ABBREVIATION"];
}

$sql = "Insert into student values (?,?,?)";
            $stmt = mysqli_prepare($connection, $sql);
            mysqli_stmt_bind_param($stmt, 'sss', $STUDENT_ID, $NAME, $ABBREVIATION);
            if (!mysqli_stmt_execute($stmt)) {
                echo "STUDENT_ID existiert bereits";
            }
header( uriString("/createStudents.php"));

?>