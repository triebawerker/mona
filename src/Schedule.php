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
    /**
     * @var int
     */
    private $timeSlotLength;

    /**
     * @var int
     */
    private $days;

    /**
     * @var int
     */
    private $hours;

    public function addSchoolClass(SchoolClass $schoolClass)
    {
        $timeSlot = new TimeSlot();
        $this->addTimeslot($timeSlot);
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
    private function addTimeslot($timeSlot)
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

    public function setTimeSlotLength($length)
    {
        $this->timeSlotLength = $length;
    }

    public function getTimeSlotLength()
    {
        return $this->timeSlotLength;
    }

    public function setDays($days)
    {
        $this->days = $days;
    }

    public function getDays()
    {
        return $this->days;
    }

    public function setHours($hours)
    {
        $this->hours = $hours;
    }

    public function getHours()
    {
        return $this->hours;
    }

    public function getScheduleNumberOfSlots()
    {
        $slotLengthPerHour = 60/$this->getTimeSlotLength();
        return $this->getDays() * $this->getHours() * $slotLengthPerHour;
    }
}