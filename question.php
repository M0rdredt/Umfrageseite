<?php
include_once "includes.php";
$user = $_SESSION["User"];
$studentId = $user["STUDENT_ID"];
$q_number = $_POST["q_number"];
if (isset($_POST["questionAnswer"])){
    $value = $_POST["questionAnswer"];
    insert_update_answer($q_number - 1 , $_POST['questionnaire_id'], $studentId, $connection, $value);
}
$formQuestionEnd = false;
echo $q_number;

$isChecked1 = isChecked($studentId, $_POST["questionnaire_id"], $q_number, $connection) == 1 ? "checked":" ";
$isChecked2 = isChecked($studentId, $_POST["questionnaire_id"], $q_number, $connection) == 2 ? "checked":" ";
$isChecked3 = isChecked($studentId, $_POST["questionnaire_id"], $q_number, $connection) == 3 ? "checked":" ";
$isChecked4 = isChecked($studentId, $_POST["questionnaire_id"], $q_number, $connection) == 4 ? "checked":" ";
$isChecked5 = isChecked($studentId, $_POST["questionnaire_id"], $q_number, $connection) == 5 ? "checked":" ";
$q_number++;
if (isMaxQuestionNumber($q_number, $_POST["questionnaire_id"], $connection)){
    $formQuestionEnd = true;
}
echo "
<form method='post' action='".QuestionEnd($formQuestionEnd)."'>
<input type='submit' name='NextQuestion'>
<input type='radio' name='questionAnswer' value='1'".$isChecked1.">
<input type='radio' name='questionAnswer' value='2'".$isChecked2.">
<input type='radio' name='questionAnswer' value='3'".$isChecked3.">
<input type='radio' name='questionAnswer' value='4'".$isChecked4.">
<input type='radio' name='questionAnswer' value='5'".$isChecked5.">
<input type='hidden' name='q_number' value='".$q_number."'>
<input type='hidden' name='questionnaire_id' value='".$_POST["questionnaire_id"]."'>
</form>";

function insert_update_answer($qNumber, $questionnaireID, $studentID, $connection, $value){
    $sqlInsert = "insert into answers values (?, ?, ?, ?)";
    $sqlUpdate = "update answers set answer = ? where student_id = ? and questionnaire_id = ? and q_number = ?;";
    $stmtInsert = mysqli_prepare($connection, $sqlInsert);
    mysqli_stmt_bind_param($stmtInsert, 'ssss', $studentID, $questionnaireID, $qNumber, $value);
    if (!mysqli_stmt_execute($stmtInsert)) {
        $stmtUpdate = mysqli_prepare($connection, $sqlUpdate);
        mysqli_stmt_bind_param($stmtUpdate, 'ssss', $value, $studentID, $questionnaireID, $qNumber);
        if (!mysqli_stmt_execute($stmtUpdate)) {
            throw new Exception();
        }
    }
}

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



