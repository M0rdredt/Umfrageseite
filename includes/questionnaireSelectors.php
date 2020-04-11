<!--AUTHOR: Willi Hertel-->
<?php
include_once 'includes.php';
//returns a html-String which describes a table with all the Questionnaires for a course
function getQuestionnaireTableByCourse($course, $conn)
{
    $toReturn = "<table>
                    <tr>
                        <th>Name</th>
                        <th>Link</th>
                        <th>Erzeuger</th>
                    </tr>";
    $sql = "SELECT q.name as NAME, q.QUESTIONNAIRE_ID as QUESTIONNAIRE_ID, q.USER_ID as USER_ID
            FROM QUESTIONNAIRE Q, WORKS_WITH W 
            where Q.QUESTIONNAIRE_ID = W.QUESTIONNAIRE_ID
            and W.ABBREVIATION = ?";
    $stmt = mysqli_prepare($conn, $sql);
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL statement ist fehlerhaft!";
    } else {
        mysqli_stmt_bind_param($stmt, "s", $course);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            $toReturn .= "<tr> 
                            <td>".$row['NAME'] ."</td>
                            <td><a href='questionnaireFront.php?ID=" . $row['QUESTIONNAIRE_ID'] . "'>Link</a></td>
                            <td>".$row['USER_ID']. "</td>
                           </tr>";
        }
    }
    $toReturn .= "</table>";
    return $toReturn;
}