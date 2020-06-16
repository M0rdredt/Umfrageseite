<!--AUTHOR: David Horseling -->
<?php
include_once "includes.php";


$USER = $_SESSION["User"];
$QUESTIONNAIRE_NAME = $_POST["QuestionnaireName"];
$QUESTIONNAIRE_CREATOR = $USER["USER_ID"];

$AmountQuestions = $_POST["AmountQuestions"];

$Counter = 1;


mysqli_autocommit($connection, false);
//Im Folgenden wird die bisher höchste QUESTIONNAIRE_ID ermittelt und die der neuen Umfrage festgelegt, wenn noch keine Umfrage existiert, wird die ID 1 gewählt
$SQL_QUESTIONNAIRE_ID = "select max(QUESTIONNAIRE_ID) as maxQuestID from Questionnaire";
$stmtQuestionnaireID = mysqli_prepare($connection, $SQL_QUESTIONNAIRE_ID);
        mysqli_stmt_execute($stmtQuestionnaireID);
        $result = mysqli_stmt_get_result($stmtQuestionnaireID);
		$row = mysqli_fetch_assoc($result);

$QUESTIONNAIRE_ID = $row["maxQuestID"];
if($QUESTIONNAIRE_ID<1) {
	$QUESTIONNAIRE_ID = 1;
} else {
$QUESTIONNAIRE_ID ++;
}
//Im Folgenden wird die Umfrage eingefügt
$sqlQuestionnaire = "Insert into questionnaire values (?,?,?)";
            $stmtQuestionnaire = mysqli_prepare($connection, $sqlQuestionnaire);
            mysqli_stmt_bind_param($stmtQuestionnaire, 'sss', $QUESTIONNAIRE_ID, $QUESTIONNAIRE_NAME, $QUESTIONNAIRE_CREATOR);
            if (!mysqli_stmt_execute($stmtQuestionnaire)) {
                echo "Umfragename exisitiert bereits";
				mysqli_rollback($connection);
				exit;
            }
//Im Folgenden werden die Einzelnen Fragen eingefügt mit einer jeweils um 1 erhöhten Q_Number			
while ($Counter <= $AmountQuestions) {
	$Question = $_POST[$Counter];
	$sqlQuestionnaire = "Insert into question values (?,?,?)";
            $stmtQuestionnaire = mysqli_prepare($connection, $sqlQuestionnaire);
            mysqli_stmt_bind_param($stmtQuestionnaire, 'sss', $QUESTIONNAIRE_ID, $Counter, $Question);
            if (!mysqli_stmt_execute($stmtQuestionnaire)) {
                echo "Fehler bei Frageerstellung aufgetreten";
				mysqli_rollback($connection);
				exit;
            }
	
	$Counter++;
}
mysqli_commit($connection);
mysqli_autocommit($connection, true);
echo "Umfrage wurde erfolgreich mit ihren Fragen erstellt!";
?>