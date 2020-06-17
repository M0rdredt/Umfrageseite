<!--AUTHOR: Viktor Matussis -->
<?php
include_once 'includes.php';

$USER = $_SESSION["User"];

$QUESTIONNAIRE_CREATOR = $USER["USER_ID"];

if (!isset($_POST["NAME"])) {
  echo "No NAME";
} else {
  $NAME = $_POST["NAME"];
}

$SQL_QUESTIONNAIRE_ID = "select * from Questionnaire WHERE NAME = ?";
$stmt = mysqli_prepare($connection, $SQL_QUESTIONNAIRE_ID);
mysqli_stmt_bind_param($stmt, 's', $NAME);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$QUESTIONNAIRE_ID_Array = mysqli_fetch_assoc($result);
$QUESTIONNAIRE_ID = $QUESTIONNAIRE_ID_Array['QUESTIONNAIRE_ID'];

$SQL_Questions = "select * from Question WHERE QUESTIONNAIRE_ID = ?";
$stmt = mysqli_prepare($connection, $SQL_Questions);
mysqli_stmt_bind_param($stmt, 's', $QUESTIONNAIRE_ID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

while ($row = mysqli_fetch_assoc($result)){
$sql = "select min(answer) as Min,max(answer)as Max, avg(answer) as Avg from answers where QUESTIONNAIRE_ID =? AND  Q_Number =?";
$stmt = mysqli_prepare($connection, $sql);
mysqli_stmt_bind_param($stmt, 'ss', $QUESTIONNAIRE_ID,$row["Q_NUMBER"]);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$sql_result = mysqli_fetch_assoc($result);
echo "Min: " .$sql_result["Min"].'<br>';
echo "Max: " .$sql_result["Max"].'<br>';
echo "Avg: " .$sql_result["Avg"].'<br>';


$sql_deviation = "select answer from answers where QUESTIONNAIRE_ID =? AND  Q_Number =?";
$stmt = mysqli_prepare($connection, $sql_deviation);
mysqli_stmt_bind_param($stmt, 'ss', $QUESTIONNAIRE_ID,$row["Q_NUMBER"]);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$array  = array();
while ($sql_result = mysqli_fetch_assoc($result))
{
  array_push($array,$sql_result["answer"]);
}

echo "Stand_Abweichung: ".Stand_Deviation($array)."<br>";
}

$SQL_Makes = "select * from Makes WHERE QUESTIONNAIRE_ID = ?";
$stmt = mysqli_prepare($connection, $SQL_Makes);
mysqli_stmt_bind_param($stmt, 's', $QUESTIONNAIRE_ID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
//$Comment;

while ($row = mysqli_fetch_assoc($result)){
echo $row["COMMENT"].'<br>';

}

	function Stand_Deviation($arr)
	{
		$num_of_elements = count($arr);

		$variance = 2.0;


		$average = array_sum($arr)/$num_of_elements;

		foreach($arr as $i)
		{

			$variance += pow(($i - $average), 2);
		}

		return (float)sqrt($variance/$num_of_elements);
	}

?>
