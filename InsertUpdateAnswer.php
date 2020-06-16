<!--AUTHOR: WILLI HERTEL-->
<?php
//inserted oder updated die Antwort eines Studenten zu einem Fragebogen
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