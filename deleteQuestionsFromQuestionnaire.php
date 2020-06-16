<!--AUTHOR: David Horseling -->
<?php
include_once 'includes.php';

echo "<h1>Hier können Sie die Umfrage auswählen, aus der Sie eine Frage löschen möchten.</h1>";

//Das HTML wird in diese Variable geschrieben um es am Ende über Echo auszugeben		
$formToDeleteQuestion =	"<form method=\"post\" action=\"deleteQuestion.php\">";
		
//Diese Daten brauche ich um nur die Umfragen anzeigen zu lassen, die von diesem Creator erstellt wurden
$USER = $_SESSION["User"];
$USER_ID = $USER["USER_ID"];
// Hier werden alle Umfragen über eine Combo Box zur Auswahl gestellt, die von dem aktuellen Nutzer erstellt wurden und noch von keinem Studenten
//bearbeitet wurden. Alternativ könnte man NOT IN (SELECT QUESTIONNAIRE_ID FROM ANSWERS abfragen, dann würde man so im Mehrbenutzerbetrieb Risiken eingehen
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
			$formToDeleteQuestion .="<br> Hier die Umfrage auswählen, die bearbeitet werden soll: <br>
			<select id=\"NAME\" name=\"NAME\">";
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			while ($row = mysqli_fetch_assoc($result)) {
				$formToDeleteQuestion .= " 
                            <option value=\"".$row['NAME'] ."\">".$row['NAME']."</option>";
			} 
			$formToDeleteQuestion .="</select>";
		}
		
	

echo $formToDeleteQuestion;
?>

	<br>
	<br>
	<input type="Submit" value="Eine Frage soll aus dieser Umfrage gelöscht werden.">

</form>