<!--AUTHOR Willi Hertel-->
<?php
    function creator_fetch($userId, $connection)
    {
        try {

        $creator = fetchByPrimaryKey("creator", array($userId), $connection);
        }catch (Exception $e){
            throw $e;
        }
        if (!(isset($creator["USER_ID"]) or $creator["PASSWORD"]))
            throw new InvalidArgumentException("No creator returned for given arguments");
        return $creator;
    }

    function creator_insert($user, $password, $connection)
    {
            $sql = "Insert into creator values (?, ?)";
            $stmt = mysqli_prepare($connection, $sql);
            mysqli_stmt_bind_param($stmt, 'ss', $user, $password);
            if (!mysqli_stmt_execute($stmt)) {
                throw new MySqlException(mysqli_error($connection));
            }
    }

    function creator_login($userId, $password, $connection)
    {
        $user = null;
        if($userId ==null or $password ==null)
        {
            throw new InvalidArgumentException("Password or Username is null");
        }
        try {
            $user = creator_fetch($userId, $connection);
        } catch (Exception $e) {
            throw $e;
        }

        if (!password_verify($password, $user["PASSWORD"])) {
            throw new WrongPasswordException("Password is wrong!");
        }

        $_SESSION["User"] = $user;
        $_SESSION["Role"] = "C";
    }

    function creator_register($userId, $password, $password2, $connection)
    {
        $user = "ranS";
        try {
            $user = creator_fetch($userId, $connection);
        } catch (Exception $e) {
            //No Data found is correct because fetch should return no data if user does not exist
            null;
        }

        if($user != "ranS")
            throw new InvalidArgumentException("Username does already exist ");

        if ($password != $password2) {
            throw new WrongPasswordException("Password2 does not equal password!");
        }

        try {
            creator_insert($userId,password_hash($password, PASSWORD_BCRYPT) ,$connection);
            $user = creator_fetch($userId, $connection);
        } catch (Exception $e) {
            throw $e;
        }

        $_SESSION["User"] = $user;
        $_SESSION["Role"] = "C";
        }