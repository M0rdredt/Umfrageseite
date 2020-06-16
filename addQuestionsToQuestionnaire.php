<!--AUTHOR: David Horseling -->
<?php
include_once 'includes.php';

echo "<h1>Hier können Sie die Umfrage auswählen, der Sie die Frage hinzufügen möchten.</h1>";

		
$formToAddQuestion =	"<form method=\"post\" action=\"addNewQuestion.php\">";
		
//Diese Daten werden benötigt, um nur die vom Creator erstellten Umfragen anzeigen zu lassen
$USER = $_SESSION["User"];
$USER_ID = $USER["USER_ID"];
//Hier werden alle Umfragen über eine Combo Box zur Auswahl gestellt, die von dem aktuellen Nutzer erstellt wurden und noch von keinem Studenten
//bearbeitet wurden. Alternativ könnte man NOT IN (SELECT QUESTIONNAIRE_ID FROM ANSWERS) abfragen, dann würde man so im Mehrbenutzerbetrieb Risiken eingehen
//denn nach derzeitigem Vorgehen, könnten so auch im Mehrbenutzerbetrieb keine Studenten Umfragen noch beantworten, während der Creator bereits Fragen löscht oder hinzufügt.
//Besser gesagt, hat der Creator keine Möglichkeit mehr Umfragen zu verändern, die womöglich schon von Studenten bearbeitet werden.
$sql2 = "select NAME from QUESTIONNAIRE where USER_ID = ? AND QUESTIONNAIRE_ID NOT IN (SELECT QUESTIONNAIRE_ID FROM WORKS_WITH)";
$stmt = mysqli_prepare($connection, $sql2);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
		
		if (!mysqli_stmt_prepare($stmt, $sql2)) {
			echo "SQL statement ist fehlerhaft!";
		} else {
			mysqli_stmt_bind_param($stmt, 's', $USER_ID);
			$formToAddQuestion .="<br> Hier die Umfrage auswählen, die bearbeitet werden soll: <br>
			<select id=\"NAME\" name=\"NAME\">";
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			while ($row = mysqli_fetch_assoc($result)) {
				$formToAddQuestion .= " 
                            <option value=\"".$row['NAME'] ."\">".$row['NAME']."</option>";
			} 
			$formToAddQuestion .="</select>";
		}
		
	

echo $formToAddQuestion;
?>

	<br>
	Fragelaut der neuen Frage:
	<br>
		<input required id="QUESTION" name="QUESTION"> 
	<br>
	<br>
	<input type="Submit" value="Die Frage soll zu dieser Umfrage hinzugefügt werden.">

</form>