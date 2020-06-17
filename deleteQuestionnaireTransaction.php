<!--AUTHOR: Viktor Matussis -->
<?php
include_once 'includes.php';

if (!isset($_POST["NAME"])) {
    echo "No NAME";
} else {
    $NAME = $_POST["NAME"];
}

$SQL_QUESTIONNAIRE_ID = "select QUESTIONNAIRE_ID from Questionnaire WHERE NAME = ?";
$stmt = mysqli_prepare($connection, $SQL_QUESTIONNAIRE_ID);
    mysqli_stmt_bind_param($stmt, 's', $NAME);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    $QUESTIONNAIRE_ID_Array = mysqli_fetch_assoc($result);
    $QUESTIONNAIRE_ID = $QUESTIONNAIRE_ID_Array['QUESTIONNAIRE_ID'];
//Im Folgenden wird überprüft, dass der Primärschlüssel für die Frage übergeben wurde

      mysqli_autocommit($connection, false);




$sql = "DELETE FROM answers WHERE  QUESTIONNAIRE_ID = ?";
            $stmt = mysqli_prepare($connection, $sql);
            mysqli_stmt_bind_param($stmt, 's', $QUESTIONNAIRE_ID);
            if (!mysqli_stmt_execute($stmt)) {
                echo "Etwas ist schief gelaufen.(answers)";
                mysqli_rollback($connection);
            } else {
				echo "Success";
			}
      $sql = "DELETE FROM MAKES WHERE  QUESTIONNAIRE_ID = ?";
            $stmt = mysqli_prepare($connection, $sql);
            mysqli_stmt_bind_param($stmt, 's', $QUESTIONNAIRE_ID);
            if (!mysqli_stmt_execute($stmt)) {
                echo "Etwas ist schief gelaufen.(MAKES)";
                mysqli_rollback($connection);
            } else {
				echo "Success";
			}

$sql = "DELETE FROM WORKS_WITH WHERE  QUESTIONNAIRE_ID = ?";
            $stmt = mysqli_prepare($connection, $sql);
            mysqli_stmt_bind_param($stmt, 's', $QUESTIONNAIRE_ID);
            if (!mysqli_stmt_execute($stmt)) {
                echo "Etwas ist schief gelaufen.(WORKS_WITH)";
                mysqli_rollback($connection);
            } else {
				echo "Success";
			}


$sql = "DELETE FROM QUESTION WHERE  QUESTIONNAIRE_ID = ?";
            $stmt = mysqli_prepare($connection, $sql);
            mysqli_stmt_bind_param($stmt, 's', $QUESTIONNAIRE_ID);
            if (!mysqli_stmt_execute($stmt)) {
                echo "Etwas ist schief gelaufen.(QUESTION)";
                mysqli_rollback($connection);
            } else {
				echo "Fragen wurden gelöscht.";
			}
$sql = "DELETE FROM QUESTIONNAIRE WHERE  QUESTIONNAIRE_ID = ?";
                  $stmt = mysqli_prepare($connection, $sql);
                  mysqli_stmt_bind_param($stmt, 's', $QUESTIONNAIRE_ID);
                  if (!mysqli_stmt_execute($stmt)) {
                      echo "Etwas ist schief gelaufen.(QUESTIONNAIRE)";
                      mysqli_rollback($connection);
                  } else {
      				echo "Fragebogen wurden gelöscht.";
      			}


      mysqli_commit($connection);
      mysqli_autocommit($connection, true);
      echo "Die Umfrage wurde gelöscht";
//testen
?>
