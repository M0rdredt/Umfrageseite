<!--AUTHOR: David Horseling -->
<?php
include_once "includes.php";

mysqli_autocommit($connection, false);

if (!isset($_POST["NAME"])) {
    echo "No NAME";
} else {
    $NAME = $_POST["NAME"];
}


$SQL_QUESTIONNAIRE_ID = "select QUESTIONNAIRE_ID from Questionnaire WHERE NAME = ?";
$stmt = mysqli_prepare($connection, $SQL_QUESTIONNAIRE_ID);
		mysqli_stmt_bind_param($stmt, 's', $NAME);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
		$QUESTIONNAIRE_ID = mysqli_fetch_assoc($result);
		


if (!isset($_POST["ABBREVIATION"])) {
    echo "No abbreviation";
} else {
    $ABBREVIATION = $_POST["ABBREVIATION"];
}

$sql = "Insert into works_with values (?,?)";
            $stmt = mysqli_prepare($connection, $sql);
            mysqli_stmt_bind_param($stmt, 'ss', $ABBREVIATION, $QUESTIONNAIRE_ID["QUESTIONNAIRE_ID"]);
            if (!mysqli_stmt_execute($stmt)) {
                echo "Umfrage wurde dem Kurs bereits zugeordnet";
				exit;
            } 

$SQL_STUDENT_ID = "select Student_ID from Student WHERE ABBREVIATION = ?";
$stmt = mysqli_prepare($connection, $SQL_STUDENT_ID);
		mysqli_stmt_bind_param($stmt, 's', $ABBREVIATION);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
		
		while ($Student_ID = mysqli_fetch_assoc($result)) {
				
			$sqlMakes = "Insert into makes values (?,?,NULL,0)";
				$stmt = mysqli_prepare($connection, $sqlMakes);
				mysqli_stmt_bind_param($stmt, 'ss', $Student_ID["Student_ID"], $QUESTIONNAIRE_ID["QUESTIONNAIRE_ID"]);
				if (!mysqli_stmt_execute($stmt)) {
					echo "Umfrage wurde dem Kurs bereits zugeordnet";
					exit;
            } 	
				
		} 
			
	echo "Umfrage wurde dem Kurs inklusive Studenten zugewiesen";


mysqli_commit($connection); 
mysqli_autocommit($connection, true);
?>
