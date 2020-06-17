<!--AUTHOR: Viktor Matussis -->
<?php
include_once 'includes.php';

$USER = $_SESSION["User"];
$QUESTIONNAIRE_NAME = $_POST["QuestionnaireName"];
$QUESTIONNAIRE_CREATOR = $USER["USER_ID"];

if (!isset($_POST["NAME"])) {
  echo "No NAME";
} else {
  $NAME = $_POST["NAME"];
}

$SQL_QUESTIONNAIRE_ID = "select * from Questionnaire WHERE NAME = ?";
$stmt = mysqli_prepare($connection, $SQL_QUESTIONNAIRE_ID);
mysqli_stmt_bind_param($stmt, 's', $NAME);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$QUESTIONNAIRE_ID_Array = mysqli_fetch_assoc($result);
$QUESTIONNAIRE_ID = $QUESTIONNAIRE_ID_Array['QUESTIONNAIRE_ID'];







mysqli_autocommit($connection, false);

$SQL_QUESTIONNAIRE_ID = "select max(QUESTIONNAIRE_ID) as maxQuestID from Questionnaire";
$stmtQuestionnaireID = mysqli_prepare($connection, $SQL_QUESTIONNAIRE_ID);
mysqli_stmt_execute($stmtQuestionnaireID);
$result = mysqli_stmt_get_result($stmtQuestionnaireID);
$row = mysqli_fetch_assoc($result);

$QUESTIONNAIRE_ID_new = $row["maxQuestID"];
if($QUESTIONNAIRE_ID_new<1) {
  $QUESTIONNAIRE_ID_new = 1;
} else {
  $QUESTIONNAIRE_ID_new ++;
}

$sqlQuestionnaire = "Insert into questionnaire values (?,?,?)";
$stmtQuestionnaire = mysqli_prepare($connection, $sqlQuestionnaire);
mysqli_stmt_bind_param($stmtQuestionnaire, 'sss', $QUESTIONNAIRE_ID_new, $QUESTIONNAIRE_NAME, $QUESTIONNAIRE_CREATOR);
if (!mysqli_stmt_execute($stmtQuestionnaire)) {
  echo "Umfragename exisitiert bereits";
  mysqli_rollback($connection);
  exit;
}

$SQL_Questions = "select * from Question WHERE QUESTIONNAIRE_ID = ?";
$stmt = mysqli_prepare($connection, $SQL_Questions);
mysqli_stmt_bind_param($stmt, 's', $QUESTIONNAIRE_ID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);



while ($row = mysqli_fetch_assoc($result)){


  $sql = "insert into QUESTION values(?,?,?)";
  $stmt = mysqli_prepare($connection, $sql);
  mysqli_stmt_bind_param($stmt, 'sss', $QUESTIONNAIRE_ID_new,$row["Q_NUMBER"],$row["QUESTION"]);
  if (!mysqli_stmt_execute($stmt)) {
    echo "Etwas ist schief gelaufen.(QUESTION)";
    mysqli_rollback($connection);
  } else {
    echo "Fragen wurden kopiert.";
  }
}



mysqli_commit($connection);
mysqli_autocommit($connection, true);
echo "Die Umfrage wurde kopiert";
//testen
?>
