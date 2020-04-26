<?php
include_once "includes.php";
$course=null;

if (!isset($_POST["ABBREVIATION"])) {
    echo "No abbreviation";
} else {
    $abbreviation = $_POST["ABBREVIATION"];
}
$sql = "Insert into course values (?)";
            $stmt = mysqli_prepare($connection, $sql);
            mysqli_stmt_bind_param($stmt, 's', $abbreviation);
            if (!mysqli_stmt_execute($stmt)) {
                echo "Kurs existiert bereits";
            }
header( uriString("/listCourses.php"));


?>