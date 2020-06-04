<?php
include_once "includes.php";
echo "
<form method='post' action='finishQuestionnaire.php' id='submitForm'>
    <textarea cols='50' rows='10' form='submitForm' name='comment'> Gebe hier bitte deinen Fragebogenkommentar an</textarea>
    <br>
    <input type='hidden' value='".$_POST["questionnaire_id"]."' name='questionnaireId'>
    <input type='submit' name='submit' value='Fragebogen abgeben'>
</form>";