<?php

class SchoolClass
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var ClassRoom
     */
    private $classRoom;

    /**
     * @var Teacher
     */
    private $teacher;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setClassRoom($classRoom)
    {
        $this->classRoom = $classRoom;
    }

    public function getClassRoom()
    {
        return $this->classRoom;
    }

    /**
     * @param \Teacher $teacher
     */
    public function setTeacher($teacher)
    {
        $this->teacher = $teacher;
    }

    /**
     * @return \Teacher
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

}