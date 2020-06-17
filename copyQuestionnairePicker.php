<!--AUTHOR: Viktor Matussis -->
<?php
include_once "includes.php";


echo "<h1>Hier können Sie die Umfrage auswählen, die sie kopieren möchten</h1>";

//Das HTML wird in diese Variable geschrieben um es am Ende über Echo auszugeben
$formToCopyQuestionnaire =	"<form method=\"post\" action=\"copyQuestionnaire.php\">";

//nur die Umfragen anzeigen, die von diesem User erstellt wurden
$USER = $_SESSION["User"];
$USER_ID = $USER["USER_ID"];
//siehe deleteQuestionsFromQuestionnaire
$sql2 = "select NAME from QUESTIONNAIRE where USER_ID = ? AND QUESTIONNAIRE_ID NOT IN (SELECT QUESTIONNAIRE_ID FROM WORKS_WITH)";
$stmt = mysqli_prepare($connection, $sql2);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

		if (!mysqli_stmt_prepare($stmt, $sql2)) {
			echo "SQL statement ist fehlerhaft!";
		} else {
			mysqli_stmt_bind_param($stmt, 's', $USER_ID);
			$formToCopyQuestionnaire.="<br> Hier die Umfrage auswählen, die kopiert werden soll: <br>
			<select id=\"NAME\" name=\"NAME\">";
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			while ($row = mysqli_fetch_assoc($result)) {
				$formToCopyQuestionnaire .= "
														<option value=\"".$row['NAME'] ."\">".$row['NAME']."</option>";
			}
			$formToCopyQuestionnaire .="</select>";
			}



			echo $formToCopyQuestionnaire;
			?>

			<br>
			<br>
			<input type="Submit" value="Diese Umfrage soll kopiert werden.">

			</form>