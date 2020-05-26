
<?php
include_once 'includes.php';
echo "<form method='post' action='question.php'>
    <input type='hidden' name='q_number' value='1'>
    <input type='hidden' name='questionnaire_id' value='".$_POST["questionnaire_id"]."'>
    <input type='submit' name='start' value='start'>
</form>
";
