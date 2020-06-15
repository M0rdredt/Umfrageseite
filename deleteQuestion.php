<!--AUTHOR: David Horseling -->
<?php
include_once 'includes.php';

//Überprüfung ob auch tatsächlich ein Name der Umfrage mitgegeben wurde
if (!isset($_POST["NAME"])) {
    echo "No NAME";
} else {
    $NAME = $_POST["NAME"];
}

//Hier Questionnaire_ID der Umfrage ermitteln, das ist nötig da Fragen schwach sind
$SQL_QUESTIONNAIRE_ID = "select QUESTIONNAIRE_ID from Questionnaire WHERE NAME = ?";
$stmt = mysqli_prepare($connection, $SQL_QUESTIONNAIRE_ID);
		mysqli_stmt_bind_param($stmt, 's', $NAME);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
		$QUESTIONNAIRE_ID_Array = mysqli_fetch_assoc($result);
		$QUESTIONNAIRE_ID = $QUESTIONNAIRE_ID_Array['QUESTIONNAIRE_ID'];

$formToDeleteQuestion =	"Wählen Sie die zu löschende Frage aus. <br> 
								<form method=\"post\" action=\"deleteQuestionTransaction.php\"> 
								<input type='hidden' required name='QUESTIONNAIRE_ID' value='" . $QUESTIONNAIRE_ID . "'>";
								
								
$sql = "select Q_NUMBER, QUESTION from QUESTION where QUESTIONNAIRE_ID = ?";
$stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			echo "SQL statement ist fehlerhaft!";
		} else {
			mysqli_stmt_bind_param($stmt, 's', $QUESTIONNAIRE_ID);
			$formToDeleteQuestion .="<br> Hier die Frage auswählen, die gelöscht werden soll: <br>
			<select  name=\"Q_NUMBER\">";
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			while ($row = mysqli_fetch_assoc($result)) {
				$formToDeleteQuestion .= " 
                            <option value=\"".$row['Q_NUMBER'] ."\">".$row['QUESTION']."</option>";
			} 
			$formToDeleteQuestion .="</select>";
		}
		
	

echo $formToDeleteQuestion;
?>

	<br>
	<br>
	<input type="Submit" value="Diese Frage soll aus der Umfrage gelöscht werden.">

</form>