<!--AUTHOR: WILLI HERTEL-->
<?php
include_once 'includes.php';
//Formular bevor der eigentliche Fragebogen begonnen wird
$formQuestionEnd = false;
if (isMaxQuestionNumberNull($_POST["questionnaire_id"], $connection)){
    $formQuestionEnd = true;
}
echo "<form method='post' action='".QuestionEnd($formQuestionEnd)."'>
    <input type='hidden' name='q_number' value='".getMinQuestionNumber($_POST["questionnaire_id"],$connection)."'>
    <input type='hidden' name='questionnaire_id' value='".$_POST["questionnaire_id"]."'>
    <button type='submit' name='start' value='start'>Fragebogen beginnen</button>
</form>
";
include_once "EndOfPage.php";

//wenn keine Frage existiert wird direkt auf die Endeseite gesprungen(sollte jetzt hinfällig sein
// da keine Fragebögen ohne Fragen existieren können sollten
// und dient nur noch dazu um in diesem Fall nicht in einen vermeidbaren Fehler zu laufen)
function isMaxQuestionNumberNull($questionnaire, $connection){
    $sql = "select max(q_number) as num from question where questionnaire_id = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "s", $questionnaire);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $value = mysqli_fetch_assoc($result);
    if($value["num"] == null)
    {
        return true;
    }
}

function QuestionEnd($formQuestionEnd){
    if ($formQuestionEnd)
        return "questionEnd.php";
    else
        return "question.php";
}

//holt die minimale Fragenummer um q_number inital zu befüllen
function getMinQuestionNumber($questionnaire,$connection){
    $sql = "select min(q_number) as num from question where questionnaire_id = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "s", $questionnaire);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $value = mysqli_fetch_assoc($result);
    return $value["num"];
}