<!--AUTHOR: Viktor Matussis -->
<?php
include_once 'includes.php';

//Überprüfung ob auch tatsächlich ein Name der Umfrage mitgegeben wurde, für den Fall, dass etwas schief gelaufen ist
if (!isset($_POST["NAME"])) {
    echo "No NAME";
} else {
    $NAME = $_POST["NAME"];
}

//Hier Questionnaire_ID der Umfrage ermitteln, das ist nötig da Fragen schwach an der QUESTIONNAIRE_ID sind und um umfragen zu löschhen alle fragen zu löschen sind
$SQL_QUESTIONNAIRE_ID = "select QUESTIONNAIRE_ID from Questionnaire WHERE NAME = ?";
$stmt = mysqli_prepare($connection, $SQL_QUESTIONNAIRE_ID);
		mysqli_stmt_bind_param($stmt, 's', $NAME);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
		$QUESTIONNAIRE_ID_Array = mysqli_fetch_assoc($result);
		$QUESTIONNAIRE_ID = $QUESTIONNAIRE_ID_Array['QUESTIONNAIRE_ID'];




//Um eine Umfrage zu löschen sollten keine fragen enthalten sein. Daher werden alle fragen in der Umfrage gelöscht bevor diese gelöscht wird.
// auch Antworten , WORKS_WITH etc.





echo $formToDeleteQuestionnaire;
?>
