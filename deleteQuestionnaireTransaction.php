<!--AUTHOR: Viktor Matussis -->
<?php
include_once 'includes.php';


//Im Folgenden wird überprüft, dass der Primärschlüssel für die Frage übergeben wurde
if (!isset($_POST["QUESTIONNAIRE_ID"])) {
    echo "No Questionnnaire_ID";
} else {
    $QUESTIONNAIRE_ID = $_POST["QUESTIONNAIRE_ID"];
}



$sql = "DELETE FROM QUESTION WHERE  QUESTIONNAIRE_ID = ?";
            $stmt = mysqli_prepare($connection, $sql);
            mysqli_stmt_bind_param($stmt, 'ss', $QUESTIONNAIRE_ID);
            if (!mysqli_stmt_execute($stmt)) {
                echo "Etwas ist schief gelaufen.";
            } else {
				echo "Fragen wurden gelöscht.";
			}
}
?>
