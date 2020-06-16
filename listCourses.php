
<!--AUTHOR: David Horseling -->
<?php
include_once 'includes.php';
$listOfCourses =	"<h1>Liste aller Kurse, die es gibt:</h1>
					<ul>";
//Im Folgenden werden alle Kurse die existieren ausgegeben		
$sql = "select *
		from course";
$stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_assoc($result);
		
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			echo "SQL statement ist fehlerhaft!";
		} else {
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			while ($row = mysqli_fetch_assoc($result)) {
				$listOfCourses .= " 
                            <li>".$row['ABBREVIATION'] ."</li>
                            ";
			} 
			$listOfCourses .="</ul>";
		}
		
Echo $listOfCourses;
// Im Folgenden kann ein neuer Kurs angelegt werden
?>
<form method="post" action="createCourse.php"> 
	<label for="ABBREVIATION"> Hier kann ein neuer Kurs hinzugefügt werden:
	<br>
		<input required id="ABBREVIATION" name="ABBREVIATION"> 
	<br>
	Bitte geben Sie das Kurskuerzel ein
	<br><br>
	Durch drücken der Enter-Taste, wird der Kurs hinzugefügt.
	</label>
</form> 