<!--AUTHOR: WILLI HERTEL-->
<?php
include_once "includes.php";
include_once "InsertUpdateAnswer.php";
$user = $_SESSION["User"];
$studentId = $user["STUDENT_ID"];
$q_number = $_POST["q_number"];
if (isset($_POST["questionAnswer"])){
    $value = $_POST["questionAnswer"];
    insert_update_answer($q_number - 1 , $_POST['questionnaire_id'], $studentId, $connection, $value);
}
$formQuestionEnd = false;
$questionnaireNumber = $_POST["questionnaire_id"];
echo getQuestion($q_number, $questionnaireNumber, $connection);

$isChecked1 = isChecked($studentId, $questionnaireNumber, $q_number, $connection) == 1 ? "checked":" ";
$isChecked2 = isChecked($studentId, $questionnaireNumber, $q_number, $connection) == 2 ? "checked":" ";
$isChecked3 = isChecked($studentId, $questionnaireNumber, $q_number, $connection) == 3 ? "checked":" ";
$isChecked4 = isChecked($studentId, $questionnaireNumber, $q_number, $connection) == 4 ? "checked":" ";
$isChecked5 = isChecked($studentId, $questionnaireNumber, $q_number, $connection) == 5 ? "checked":" ";
$q_number++;
if (isMaxQuestionNumber($q_number, $questionnaireNumber, $connection)){
    $formQuestionEnd = true;
}
echo "
<form method='post' action='".QuestionEnd($formQuestionEnd)."'>
<label>1: </label>
<input type='radio' name='questionAnswer' value='1'".$isChecked1.">
<label>2: </label>
<input type='radio' name='questionAnswer' value='2'".$isChecked2.">
<label>3: </label>
<input type='radio' name='questionAnswer' value='3'".$isChecked3.">
<label>4: </label>
<input type='radio' name='questionAnswer' value='4'".$isChecked4.">
<label>5: </label>
<input type='radio' name='questionAnswer' value='5'".$isChecked5.">
<br>
<input type='submit' name='NextQuestion' value='Antwort senden'>
<input type='hidden' name='q_number' value='".$q_number."'>
<input type='hidden' name='questionnaire_id' value='".$questionnaireNumber."'>
</form>";
include_once "EndOfPage.php";


//returns 12345 if a value is present and 0 if an exception occured
function isChecked($studentId, $questionnaireId, $q_number, $connection){
    try {
        $row = fetchByPrimaryKey("answers", array($studentId,$questionnaireId, $q_number ), $connection);
    } catch (Exception $e) {
        return 0;
    }
    return $row["ANSWER"];
}

function isMaxQuestionNumber($qNumber, $questionnaire, $connection){
    $sql = "select max(q_number) as num from question where questionnaire_id = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "s", $questionnaire);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $value = mysqli_fetch_assoc($result);
    if($value["num"]>=$qNumber){
        return false;}
    else{
        return true;}
}


function QuestionEnd($formQuestionEnd){
    if ($formQuestionEnd)
        return "questionEnd.php";
    else
        return "question.php";
}

function getQuestion($qNumber, $questionnaireNumber, $connection){

    $question = fetchByPrimaryKey("question", array($questionnaireNumber, $qNumber),$connection);
    return $question["QUESTION"];
}



