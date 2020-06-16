<!--AUTHOR: Willi Hertel-->
<?php
include_once 'includes.php';
//gibt einen html String zurück mit allen Fragebögen zu Kurs
function getQuestionnaireTableByCourse($course, $conn)
{
    $toReturn = "<form method='post' action='../questionnaireFront.php'><table>
                    <tr>
                        <th>Name</th>
                        <th>Link</th>
                        <th>Erzeuger</th>
                    </tr>";
    $sql = "SELECT *
            FROM QUESTIONNAIRE Q, WORKS_WITH W, makes m
            where Q.QUESTIONNAIRE_ID = W.QUESTIONNAIRE_ID
                and m.QUESTIONNAIRE_ID = q.QUESTIONNAIRE_ID
                and W.ABBREVIATION = ?
                and m.Student_Id = ?
                and m.FINISHED != 1";
    $stmt = mysqli_prepare($conn, $sql);
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL statement ist fehlerhaft!";
    } else {
        $user = $_SESSION["User"];
        mysqli_stmt_bind_param($stmt, "ss", $course, $user["STUDENT_ID"]);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            $toReturn .= "<tr> 
                            <td>".$row['NAME'] ."</td>
                            <td><button type='submit' name='questionnaire_id' value ='" . $row['QUESTIONNAIRE_ID'] . "'>Fragebogen beginnen</button></td>
                            <td>".$row['USER_ID']. "</td>
                           </tr>";
        }
    }
    $toReturn .= "</table></form>";
    return $toReturn;
}