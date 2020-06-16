<!--AUTHOR: David Horseling -->
<?php

include_once 'includes.php';

echo "<h1>Hier können Studenten angelegt werden, die einem Kurs angehören</h1>";

$formToInsertStudent =	"<form method=\"post\" action=\"insertStudent.php\">";
//Im Folgenden werden alle Kurse über eine Combo Box zur Auswahl gestellt	
$sql = "select *
		from course";
$stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_assoc($result);
		
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			echo "SQL statement ist fehlerhaft!";
		} else {
			$formToInsertStudent .="Hier den Kurs des Studenten auswählen: <br>
			<select id=\"ABBREVIATION\" name=\"ABBREVIATION\">";
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			while ($row = mysqli_fetch_assoc($result)) {
				$formToInsertStudent .= " 
                            <option value=\"".$row['ABBREVIATION'] ."\">".$row['ABBREVIATION']."</option>";
			} 
			$formToInsertStudent .="</select>";
		}
	

echo $formToInsertStudent;
//Im Folgenden können noch die Matrikelnummer und der Name des Studenten festgelegt werden.
?>
<br>
Matrikelnummer:
	<br>
		<input required id="STUDENT_ID" name="STUDENT_ID"> 
	<br>
Name:
	<br>
		<input required id="NAME" name="NAME"> 
	<br>
	<br>
	<input type="Submit" value="Student anlegen">

</form>