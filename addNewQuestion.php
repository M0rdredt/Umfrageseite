<!--AUTHOR: David Horseling -->
<?php
include_once 'includes.php';



mysqli_autocommit($connection, false);

//Überprüfung ob auch tatsächlich ein Name der Umfrage mitgegeben wurde
if (!isset($_POST["NAME"])) {
    echo "No NAME";
} else {
    $NAME = $_POST["NAME"];
}

//Überprüfung ob auch tatsächlich eine Frage mitgegeben wurde
if (!isset($_POST["QUESTION"])) {
    echo "No Question";
} else {
	$QUESTION = $_POST["QUESTION"];
}

//Hier Questionnaire_ID der Umfrage ermitteln, das ist nötig da Fragen schwach sind
$SQL_QUESTIONNAIRE_ID = "select QUESTIONNAIRE_ID from Questionnaire WHERE NAME = ?";
$stmt = mysqli_prepare($connection, $SQL_QUESTIONNAIRE_ID);
		mysqli_stmt_bind_param($stmt, 's', $NAME);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
		$QUESTIONNAIRE_ID_Array = mysqli_fetch_assoc($result);
		$QUESTIONNAIRE_ID = $QUESTIONNAIRE_ID_Array['QUESTIONNAIRE_ID'];

//Hier die Frage ID ermitteln, die die neue Frage bekommen muss
$SQL_Q_NUMBER = "select max(Q_NUMBER) as maxQ_NUMBER from Question WHERE QUESTIONNAIRE_ID = ? ";
$stmtQ_NUMBER = mysqli_prepare($connection, $SQL_Q_NUMBER);
		mysqli_stmt_bind_param($stmtQ_NUMBER, 's', $QUESTIONNAIRE_ID);
        mysqli_stmt_execute($stmtQ_NUMBER);
        $result = mysqli_stmt_get_result($stmtQ_NUMBER);
		$row = mysqli_fetch_assoc($result);

$Q_NUMBER = $row["maxQ_NUMBER"];
$Q_NUMBER ++;

//Hier neue Frage einfügen mit allen Werten

$sql = "Insert into QUESTION values (?,?,?)";
            $stmt = mysqli_prepare($connection, $sql);
            mysqli_stmt_bind_param($stmt, 'sss', $QUESTIONNAIRE_ID, $Q_NUMBER, $QUESTION);
            if (!mysqli_stmt_execute($stmt)) {
                echo "Etwas ist schief gelaufen.";
            } else {
				echo "Frage wurde hinzugefügt.";
			}


mysqli_commit($connection); 
mysqli_autocommit($connection, true);
?>
