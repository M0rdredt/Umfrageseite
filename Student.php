<!--AUTHOR Willi Hertel-->

<?php
    //METHODS
    function student_fetch($userId, $connection)
    {
        try {

            return fetchByPrimaryKey("student", array($userId), $connection);
        }catch (Exception $exception)
        {
            throw $exception;
        }
    }

    function student_login($userId, $connection)
    {
        $user= null;
        try {
            $user = student_fetch($userId, $connection);
        } catch (Exception $e) {
            throw $e;
        }
        $_SESSION["User"] = $user;
        $_SESSION["Role"] = "S";
    }