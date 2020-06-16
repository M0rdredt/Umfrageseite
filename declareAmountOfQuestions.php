<!--AUTHOR: David Horseling -->
<?php
include_once "includes.php";
//In diesem Formular wird nur die Anzahl der Fragen festgelegt und weitergegeben
?>
<form method="post" action="createQuestionnaire.php">
  Anzahl Fragen der Umfrage <br>
  <input required type="Number" name="fname" min="1"> <br>
  <input type="submit" name="Submit" value="Submit"><br>
</form>