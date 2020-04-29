<!--AUTHOR Willi Hertel>

<?php

class Student
{
    //FIELD
    private $studentId;
    private $name;
    private $course;

    //GETTER
    /**
     * @return mixed
     */
    public function getStudentId()
    {
        return $this->studentId;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getCourse()
    {
        return $this->course;
    }

    //SETTER
    /**
     * @param mixed $studentId
     */
    public function setStudentId($studentId)
    {
        $this->studentId = $studentId;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $course
     */
    public function setCourse($course)
    {
        $this->course = $course;
    }

    //CONSTRUCTOR
    function __construct($studentId, $name, $course )
    {
        $this->setName($name);
        $this->setCourse($course);
        $this->setStudentId($studentId);
    }

    //DESTRUCTOR
    public function __destruct()
    {
    }

    //METHODS
    public static function fetch($userId, $connection)
    {
        try {

        $row = DatabaseBaseObj::fetchByPrimaryKey("student", array($userId), $connection);
        return new Student($row["STUDENT_ID"], $row["NAME"], $row["ABBREVIATION"]);
        }catch (Exception $exception)
        {
            throw $exception;
        }
    }

    public function fetchAll($connection)
    {
        return array();
    }

    public function insert($student, $connection)
    {

    }

    public function insertAll($arrayOfStudents, $connection)
    {

    }

    public function update($student, $connection)
    {

    }

    public static function loginStudent($userId, $connection)
    {
        $user= null;
        try {
            $user = self::fetch($userId, $connection);
            $_SESSION["User"] = $user;
        } catch (Exception $e) {
            throw $e;
        }
    }

    //ABSTRACT
}