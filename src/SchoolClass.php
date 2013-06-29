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

    /**
     * @var DateTime
     */
    private $startDate;

    /**
     * @var string
     */
    private $startTime;

    /**
     * @var integer
     */
    private $duration;

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


    public function setStartDate(DateTime $date)
    {
        $this->startDate = $date;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param int $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param string $startTime
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }

    /**
     * @return string
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

}