<!--AUTHOR: WILLI HERTEL-->
<?php
include_once "includes.php";
include_once "InsertUpdateAnswer.php";
$user = $_SESSION["User"];
$studentId = $user["STUDENT_ID"];
$q_number = $_POST["q_number"];
if (isset($_POST["questionAnswer"])){
    $value = $_POST["questionAnswer"];
    insert_update_answer($_POST["q_numberOld"] , $_POST['questionnaire_id'], $studentId, $connection, $value);

}
$formQuestionEnd = false;
$questionnaireNumber = $_POST["questionnaire_id"];
echo getQuestion($q_number, $questionnaireNumber, $connection);

//belegt die isChecked für unten mit ihrem entsprechenden Checked oder nicht checked
$isChecked1 = isChecked($studentId, $questionnaireNumber, $q_number, $connection) == 1 ? "checked":" ";
$isChecked2 = isChecked($studentId, $questionnaireNumber, $q_number, $connection) == 2 ? "checked":" ";
$isChecked3 = isChecked($studentId, $questionnaireNumber, $q_number, $connection) == 3 ? "checked":" ";
$isChecked4 = isChecked($studentId, $questionnaireNumber, $q_number, $connection) == 4 ? "checked":" ";
$isChecked5 = isChecked($studentId, $questionnaireNumber, $q_number, $connection) == 5 ? "checked":" ";
//wir braucen sowohl alt als auch neu da Fragenummern nach dem löschen von Fragen nicht unbedingt Konsekutiv sind
$q_numberOld = $q_number;
$q_number = fetchQuestionNumber($_POST["q_number"], $questionnaireNumber, $connection);
if (!$q_number){
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
<input type='hidden' name='q_numberOld' value='".$q_numberOld."'>
<input type='hidden' name='questionnaire_id' value='".$questionnaireNumber."'>
</form>";
include_once "EndOfPage.php";


//gibt 1/2/3/4/5 zurück wenn ein Wert existiert(für die übergebenen PAramter) oder 0 wenn ein Fehler aufgetreten ist
function isChecked($studentId, $questionnaireId, $q_number, $connection){
    try {
        $row = fetchByPrimaryKey("answers", array($studentId,$questionnaireId, $q_number ), $connection);
    } catch (Exception $e) {
        return 0;
    }
    return $row["ANSWER"];
}

//testet ob eine übergebene Fragnummer die maximale Fragenummer ist
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

//existiert weil wir weiter oben möglichst einfaches form wollen
function QuestionEnd($formQuestionEnd){
    if ($formQuestionEnd)
        return "questionEnd.php";
    else
        return "question.php";
}

//holt einfach nur den Fragestring aus DB für fetchByPrimaryKey siehe DatabaseBaseObj
function getQuestion($qNumber, $questionnaireNumber, $connection){

    $question = fetchByPrimaryKey("question", array($questionnaireNumber, $qNumber),$connection);
    return $question["QUESTION"];
}

//holt Fragenummer auf basis der vorherigen Fragenummer
function fetchQuestionNumber($QNumberPrev, $questionnaireNumber, $connection){
    $sql = "select q_number from question where q_number > ? and questionnaire_id = ? order by q_number limit 1";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $QNumberPrev ,$questionnaireNumber);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $value = mysqli_fetch_assoc($result);
    if(!$value) {
        return null;
    }else{
    return $value["q_number"];
    }
    }



