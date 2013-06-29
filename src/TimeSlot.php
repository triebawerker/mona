<?php

class TimeSlot
{

    /**
     * @var SchoolClass
     */
    private $schoolClass;

    /**
     * @var bool
     */
    private $allocated = false;

    /**
     * @var int
     */
    private $startPoint;

    /**
     * @var int
     */
    private $endPoint;

    /**
     * @param $schoolClass
     */
    public function setSchoolClass($schoolClass)
    {
        $this->schoolClass = $schoolClass;
        $this->allocated = true;
    }

    /**
     * @return bool
     */
    public function isAllocated()
    {
        return $this->allocated;
    }

    public function setStartPoint()
    {
        $this->startPoint = $this->calculateStartPoint();
    }

    public function setEndPoint()
    {

        $this->endPoint = $this->calculateEndPoint();
    }

    /**
     * @return mixed
     */
    public function getStartPoint()
    {
        return $this->startPoint;
    }

    /**
     * @return mixed
     */
    public function getEndPoint()
    {
        return $this->endPoint;
    }

    /**
     * @return bool
     */
    public function hasClassStartDate()
    {
        $result = false;
        $startDate = $this->schoolClass->getStartTime();
        if(isset($startDate)) {
            $result = true;
        }
        return $result;
    }

    /**
     * @return bool
     */
    public function hasClassEndDate()
    {
        $result = false;
        $duration = $this->schoolClass->getDuration();
        if ($duration > 0) {
            $result = true;
        }
        return $result;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    private function calculateStartPoint()
    {
        $startTime = $this->schoolClass->getStartTime();

        if (!$this->validateStartTime($startTime)) {
            throw new Exception('Invalid start time');
        }
        list($hour, $minutes) = explode( ':', $startTime);
        $startPoint = $hour*(60/15) + $minutes/15;

        return $startPoint;
    }

    /**
     * @return int
     */
    private function calculateEndPoint (){
        $endPoint = $this->getStartPoint() + $this->schoolClass->getDuration()/15;
        return $endPoint;
    }

    /**
     * @param $startTime
     * @return bool
     */
    private function validateStartTime($startTime)
    {
        $validation = false;

        list($hour, $minutes) = explode( ':', $startTime);
        $checkHour = $hour > 0 && $hour <=24 ? true : false;
        $checkMinutes = $minutes > 0 && $minutes <= 60 ? true : false;

        if (preg_match('/^[0-9]{1,2}:[0-9]{2,2}$/', $startTime) && $checkHour && $checkMinutes) {
            $validation = true;
        }
        return $validation;
    }
}