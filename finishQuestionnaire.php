<!--AUTHOR: WILLI HERTEL-->
<?php
//kümmert sich aum die Abgabe des Fragebogens
include_once "includes.php";
$sqlInsert = "update makes set comment = ?, finished = 1 where student_id = ? and  questionnaire_id = ?";
$stmtInsert = mysqli_prepare($connection, $sqlInsert);
$user = $_SESSION["User"];
mysqli_stmt_bind_param($stmtInsert, 'sss', $_POST["comment"],$user["STUDENT_ID"], $_POST["questionnaireId"]);
if(!mysqli_stmt_execute($stmtInsert)){
    echo mysqli_error($connection);
}else{
    echo "Dein Fragebogen wurde erfolgreich abgegeben";
}
include_once "EndOfPage.php";
