<!--AUTHOR Willi Hertel-->
<?php
//holt Creatordaten aus DB
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
//schreibt creator in DB
    function creator_insert($user, $password, $connection)
    {
            $sql = "Insert into creator values (?, ?)";
            $stmt = mysqli_prepare($connection, $sql);
            mysqli_stmt_bind_param($stmt, 'ss', $user, $password);
            if (!mysqli_stmt_execute($stmt)) {
                throw new MySqlException(mysqli_error($connection));
            }
    }
//kümmert sich um Creator-Login
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
//kümmert sich um Creator registrieren
    function creator_register($userId, $password, $password2, $connection)
    {
        $user = "ranS";
        try {
            $user = creator_fetch($userId, $connection);
        } catch (Exception $e) {
            //No Data found ist korrekt weil fetch soll keine Daten zurückgeben, wenn kein User existiert
            null;
        }
        //creator fetch returned ein array d.h. wenn wir einen String haben muss das noch der initial gesetzte sein
        if($user != "ranS")
            throw new InvalidArgumentException("Username does already exist ");

        if ($password != $password2) {
            throw new WrongPasswordException("Password2 does not equal password!");
        }

        try {
            //mach den insert
            creator_insert($userId,password_hash($password, PASSWORD_BCRYPT) ,$connection);
            $user = creator_fetch($userId, $connection);
        } catch (Exception $e) {
            throw $e;
        }
        //setze diverse Session variablen
        $_SESSION["User"] = $user;
        $_SESSION["Role"] = "C";
        }