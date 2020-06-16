<!--AUTHOR: David Horseling -->
<?php
include_once 'includes.php';


//Im Folgenden wird überprüft, dass der Primärschlüssel für die Frage übergeben wurde
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

//Überprüfen, dass es nicht die einzige Frage der Umfrage ist
$sqlif = "SELECT COUNT(QUESTIONNAIRE_ID) AS ANZAHLFRAGEN FROM QUESTION WHERE QUESTIONNAIRE_ID = ?";
$stmtif = mysqli_prepare($connection, $sqlif);
            mysqli_stmt_bind_param($stmtif, 's', $QUESTIONNAIRE_ID);
			mysqli_stmt_execute($stmtif);
			$result = mysqli_stmt_get_result($stmtif);
			$row = mysqli_fetch_assoc($result);
			$ANZAHLFRAGEN = $row['ANZAHLFRAGEN'];

//Hier wird im Folgenden die Frage gelöscht, wenn es nicht die letzte Frage ist
IF ($ANZAHLFRAGEN<2) {
	echo "Die zu löschende Frage ist die letzte Frage, bitte greifen Sie auf die Funktion zurück die die ganze Umfrage löscht.";
}ELSE {$sql = "DELETE FROM QUESTION WHERE  QUESTIONNAIRE_ID = ? AND Q_NUMBER = ?";
            $stmt = mysqli_prepare($connection, $sql);
            mysqli_stmt_bind_param($stmt, 'ss', $QUESTIONNAIRE_ID, $Q_NUMBER);
            if (!mysqli_stmt_execute($stmt)) {
                echo "Etwas ist schief gelaufen.";
            } else {
				echo "Frage wurde gelöscht.";
			}
}
?>