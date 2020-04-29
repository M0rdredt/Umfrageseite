<!--AUTHOR Willi Hertel>
<?php

class Creator extends DatabaseBaseObj
{
    //FIELD
    private $userId;
    private $password;

    //GETTER

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
    //SETTER

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    //CONSTRUCTOR
    public function __construct($userId, $password)
    {
        $this->setPassword($password);
        $this->setUserId($userId);
    }

    //DESTRUCTOR
    private static function fetch($userId, $connection)
    {
        try {

        $user = DatabaseBaseObj::fetchByPrimaryKey("creator", array($userId), $connection);
        }catch (Exception $e){
            throw $e;
        }
        if (!(isset($user["USER_ID"]) or $user["PASSWORD"]))
            throw new InvalidArgumentException("No creator returned for given arguments");
        return new Creator($user["USER_ID"], $user["PASSWORD"]);
    }

    public function __destruct()
    {
    }

    //METHODS

    public static function insert($creator, $connection)
    {
        if ($creator instanceof Creator) {
            $user = $creator->getUserId();
            $password = $creator->getPassword();
            $sql = "Insert into creator values (?, ?)";
            $stmt = mysqli_prepare($connection, $sql);
            mysqli_stmt_bind_param($stmt, 'ss', $user, $password);
            if (!mysqli_stmt_execute($stmt)) {
                throw new MySqlException(mysqli_error($connection));
            }
        } else {
            throw new \http\Exception\InvalidArgumentException("not Instance of Creator");
        }
    }

    public function insertAll($arrayOfCreators, $connection)
    {

    }

    public function update($creator, $connection)
    {

    }

    public static function loginCreator($userId, $password, $connection)
    {
        $user = null;
        if($userId ==null or $password ==null)
        {
            throw new InvalidArgumentException("Password or Username is null");
        }
        try {
            $user = Creator::fetch($userId, $connection);
        } catch (Exception $e) {
            throw $e;
        }

        if (!password_verify($password, $user->getPassword())) {
            throw new WrongPasswordException("Password is wrong!");
        }

        $_SESSION["User"] = $user;
    }

    public static function registerCreator($userId, $password, $password2, $connection)
    {
        $user = "ranS";
        try {
            $user = self::fetch($userId, $connection);
        } catch (Exception $e) {
            //No Data found is correct because fetch should return no data if user does not exist
            null;
        }

        if($user != "ranS")
            throw new InvalidArgumentException("Username does already exist ");

        if ($password != $password2) {
            throw new WrongPasswordException("Password2 does not equal password is wrong!");
        }
        $user = new Creator($userId, password_hash($password, PASSWORD_BCRYPT));
        try {
            self::insert($user, $connection);
        } catch (Exception $e) {
            throw $e;
        }


        $_SESSION["User"] = $user;
    }

    //ABSTRACT


}