<!--AUTHOR Willi Hertel>

<?php

class DatabaseController{
    //FIELDS
    private static $dbServername = "localhost";
    private static $dbUser = "root";
    private static $dbPassword = "";
    private static $dbProdName = "umfragen";
    private $prodConnection;

    //GETTER
    /**
     * @return string
     */
    public static function getDbPassword()
    {
        return self::$dbPassword;
    }

    /**
     * @return string
     */
    public static function getDbProdName()
    {
        return self::$dbProdName;
    }

    /**
     * @return string
     */
    public static function getDbServername()
    {
        return self::$dbServername;
    }

    /**
     * @return string
     */
    public static function getDbUser()
    {
        return self::$dbUser;
    }

    /**
     * @return mixed
     */
    public function getProdConnection()
    {
        return $this->prodConnection;
    }

    //SETTER
    /**
     * @param mixed $connection
     */
    private function setConnection($connection)
    {
        $this->prodConnection = $connection;
    }

    /**
     * @param mixed $informationConnection
     */
    public function setInformationConnection($informationConnection)
    {
        $this->informationConnection = $informationConnection;
    }

    //CONSTRUCTOR

    function __construct()
    {
        $this->setConnection(mysqli_connect(self::getDbServername(), self::getDbUser(), self::getDbPassword(), self::getDbProdName()));
    }

    //DESTRUCTOR
    //METHODS
    //ABSTRACT




}