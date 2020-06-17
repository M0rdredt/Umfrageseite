<!--AUTHOR: Viktor Matussis -->
<?php
include_once 'includes.php';


echo "<h1>Hier können Sie die Umfrage auswählen, die sie auswerten möchten</h1>";

//Das HTML wird in diese Variable geschrieben um es am Ende über Echo auszugeben
$formToEvaluateQuestionnaire =	"<form method=\"post\" action=\"evaluateQuestionnaireTransaction.php\">";

//nur die Umfragen anzeigen, die von diesem User erstellt wurden
$USER = $_SESSION["User"];
$USER_ID = $USER["USER_ID"];
//siehe deleteQuestionsFromQuestionnaire
$sql2 = "select NAME from QUESTIONNAIRE where USER_ID = ?";
$stmt = mysqli_prepare($connection, $sql2);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

		if (!mysqli_stmt_prepare($stmt, $sql2)) {
			echo "SQL statement ist fehlerhaft!";
		} else {
			mysqli_stmt_bind_param($stmt, 's', $USER_ID);
			$formToEvaluateQuestionnaire.="<br> Hier die Umfrage auswählen, die ausgewertet werden soll: <br>
			<select id=\"NAME\" name=\"NAME\">";
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			while ($row = mysqli_fetch_assoc($result)) {
				$formToEvaluateQuestionnaire .= "
														<option value=\"".$row['NAME'] ."\">".$row['NAME']."</option>";
			}
			$formToEvaluateQuestionnaire .="</select>";
			}



			echo $formToEvaluateQuestionnaire;
			?>

			<br>
			<br>
			<input type="Submit" value="Diese Umfrage soll ausgewertet werden.">

			</form>
