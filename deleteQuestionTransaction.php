<!--AUTHOR: David Horseling -->
<?php
include_once 'includes.php';



if (!isset($_POST["QUESTIONNAIRE_ID"])) {
    echo "No Questionnnaire_ID";
} else {
    $QUESTIONNAIRE_ID = $_POST["QUESTIONNAIRE_ID"];
}

if (!isset($_POST["Q_NUMBER"])) {
    echo "No Q_NUMBER";
} else {
    $Q_NUMBER = $_POST["Q_NUMBER"];
}

//Hier Frage löschen mit allen Werten

$sql = "DELETE FROM QUESTION WHERE  QUESTIONNAIRE_ID = ? AND Q_NUMBER = ?";
            $stmt = mysqli_prepare($connection, $sql);
            mysqli_stmt_bind_param($stmt, 'ss', $QUESTIONNAIRE_ID, $Q_NUMBER);
            if (!mysqli_stmt_execute($stmt)) {
                echo "Etwas ist schief gelaufen.";
            } else {
				echo "Frage wurde gelöscht.";
			}

?>