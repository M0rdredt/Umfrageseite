<!--AUTHOR: David Horseling -->
<?php
include_once "includes.php";

$AmountQuestions = $_POST["fname"];

$formToCreateQuestionnaire =	"Name der Umfrage <br> 
								<form method=\"post\" action=\"insertQuestionnaireInitial.php\"> 
								<input type='Text' required name='QuestionnaireName'> <br>
								<input type='hidden' required name='AmountQuestions' value='" . $AmountQuestions . "'>";



$QuestionNumber = 0;



while ($AmountQuestions > 0) {
	$AmountQuestions = $AmountQuestions-1;
	$QuestionNumber = $QuestionNumber+1;
	$formToCreateQuestionnaire = $formToCreateQuestionnaire . "Frage Nummer" . $QuestionNumber . "<br> <input type='text' required name ='" . $QuestionNumber . "'> <br>" ;
	
}

echo $formToCreateQuestionnaire;
?>

<input type="submit" name="Submit" value="Submit"><br>
</form>
