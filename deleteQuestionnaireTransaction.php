<!--AUTHOR: Viktor Matussis -->
<?php
include_once 'includes.php';


//Im Folgenden wird überprüft, dass der Primärschlüssel für die Frage übergeben wurde
  if (!isset($_POST["QUESTIONNAIRE_ID"]))
    {
    echo "No Questionnnaire_ID";
    }
    else
    {
    $QUESTIONNAIRE_ID = $_POST["QUESTIONNAIRE_ID"];
    }
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
