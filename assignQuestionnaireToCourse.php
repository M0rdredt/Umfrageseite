<!--AUTHOR: David Horseling -->
<?php
include_once 'includes.php';

echo "<h1>Hier können Studenten angelegt werden, die einem Kurs angehören</h1>";

$formToAssignQuestionnaire =	"<form method=\"post\" action=\"assignQuestionnaire.php\">";
		
$sql = "select *
		from course";
$stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_assoc($result);
		
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			echo "SQL statement ist fehlerhaft!";
		} else {
			$formToAssignQuestionnaire .="Hier den Kurs auswählen, der einer Umfrage zugewiesen werden soll: <br>
			<select id=\"ABBREVIATION\" name=\"ABBREVIATION\">";
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			while ($row = mysqli_fetch_assoc($result)) {
				$formToAssignQuestionnaire .= " 
                            <option value=\"".$row['ABBREVIATION'] ."\">".$row['ABBREVIATION']."</option>";
			} 
			$formToAssignQuestionnaire .="</select> <br>";
		}

$USER = $_SESSION["User"];
$USER_ID = $USER["USER_ID"];

$sql2 = "select NAME from QUESTIONNAIRE where USER_ID = ?";
		if (!mysqli_stmt_prepare($stmt, $sql2)) {
			echo "SQL statement ist fehlerhaft!";
		} else {
			mysqli_stmt_bind_param($stmt, 's', $USER_ID);
			$formToAssignQuestionnaire .="<br> Hier die Umfrage auswählen, die dem Kurs zugewiesen werden soll: <br>
			<select id=\"NAME\" name=\"NAME\">";
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			while ($row = mysqli_fetch_assoc($result)) {
				$formToAssignQuestionnaire .= " 
                            <option value=\"".$row['NAME'] ."\">".$row['NAME']."</option>";
			} 
			$formToAssignQuestionnaire .="</select>";
		}
		
	

echo $formToAssignQuestionnaire;
?>

	<br>
	<br>
	<input type="Submit" value="UmfrageZuweisen">

</form>