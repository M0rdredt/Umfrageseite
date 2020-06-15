<!--AUTHOR: WILLI HERTEL-->
<?php
include_once "includes.php";
include_once "InsertUpdateAnswer.php";
$user = $_SESSION["User"];
if (isset($_POST["questionAnswer"])){
insert_update_answer($_POST["q_numberOld"] , $_POST["questionnaire_id"], $user["STUDENT_ID"], $connection, $_POST["questionAnswer"]);
}
echo "
<form method='post' action='finishQuestionnaire.php' id='submitForm'>
    <textarea cols='50' rows='10' form='submitForm' name='comment'> Gebe hier bitte deinen Fragebogenkommentar an</textarea>
    <br>
    <input type='hidden' value='".$_POST["questionnaire_id"]."' name='questionnaireId'>
    <input type='submit' name='submit' value='Fragebogen abgeben'>
</form>";
include_once "EndOfPage.php";