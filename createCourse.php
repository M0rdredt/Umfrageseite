<!--AUTHOR: David Horseling -->
<?php
include_once "includes.php";
$course=null;

//Im Folgenden wird überprüft, ob ein Kurs erfolgreich mitgegeben wurde
if (!isset($_POST["ABBREVIATION"])) {
    echo "No abbreviation";
} else {
    $abbreviation = $_POST["ABBREVIATION"];
}
//Im Folgenden wird der Kurs in der Datenbank angelegt 
$sql = "Insert into course values (?)";
            $stmt = mysqli_prepare($connection, $sql);
            mysqli_stmt_bind_param($stmt, 's', $abbreviation);
            if (!mysqli_stmt_execute($stmt)) {
                echo "Kurs existiert bereits";
            } else {
				header( uriString("/listCourses.php"));
			}

?>