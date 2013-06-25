<?php

class Schedule
{

    /**
     * @var SchoolClass
     */
    private $schoolClass = array();

    /**
     * @var array TimeSlot
     */
    private $timeSlots = array();

    public function addSchoolClass($schoolClass)
    {
        $this->schoolClass = $schoolClass;
    }

    public function addSchool(SchoolClass $schoolClass)
    {
        array_push($this->schoolClass, $schoolClass);
    }

    public function getSchool()
    {
        return $this->schoolClass;
    }

    public function getList()
    {
        return $this->schoolClass;
    }

    /**
     * @param TimeSlot $timeSlot
     */
    public function addTimeslot($timeSlot)
    {
        array_push($this->timeSlots, $timeSlot);
    }

    /**
     * @return TimeSlot[]
     */
    public function getBookedSlots()
    {
        $bookedSlots = array();
        foreach ($this->timeSlots as $slot) {
            if ($slot->isAllocated()) {
                array_push($bookedSlots, $slot);
            } else {
                continue;
            }
        }
        return $bookedSlots;
    }

    /**
     * @return TimeSlot[]
     */
    public function getFreeSlots()
    {
        $freeSlots = array();
        foreach ($this->timeSlots as $slot) {
            if ($slot->isAllocated()) {
                continue;
            } else {
                array_push($freeSlots, $slot);
            }
        }
        return $freeSlots;
    }
}