
<?php

include_once 'includes.php';

echo "<h1>Hier können Studenten angelegt werden, die einem Kurs angehören</h1>";

$formToInsertStudent =	"<form method=\"post\" action=\"insertStudent.php\">";
		
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
			<select id=\"ABBREVIATION\" name=\"Kurs\">";
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			while ($row = mysqli_fetch_assoc($result)) {
				$formToInsertStudent .= " 
                            <option value=\"".$row['ABBREVIATION'] ."\">".$row['ABBREVIATION']."</option>";
			} 
			$formToInsertStudent .="</select>";
		}
	

echo $formToInsertStudent;
?>
<br>
Matrikelnummer:
	<br>
		<input id="STUDENT_ID" name="STUDENT_ID"> 
	<br>
Name:
	<br>
		<input id="NAME" name="NAME"> 
	<br>
</form>