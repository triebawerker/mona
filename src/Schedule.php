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
     * @var TimeSlotFactory
     */
    private $timeSlotFactory;

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


    public function __construct($timeSlotFactory)
    {
        $this->timeSlotFactory = $timeSlotFactory;
    }

    public function addSchoolClass(SchoolClass $schoolClass, TimeSlot $timeSlot = null)
    {
        /* TODO  use timeSlotFactory*/
        if (null === $timeSlot ) {
            $timeSlot = $this->timeSlotFactory->createTimeSlot();
        }

        $timeSlot->setSchoolClass($schoolClass);
        $timeSlot->setStartPoint();
        $timeSlot->setEndPoint();

        if ($this->hasTimeSlotOverlap($timeSlot)) {
            throw new Exception();
        }

        $this->addTimeslot($timeSlot);
        array_push($this->schoolClass, $schoolClass);
    }

    /**
     * @return SchoolClass[]
     */
    public function getSchoolClassList()
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
        foreach ($this->timeSlots as $slot) {;
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

    /**
     * @param TimeSlot $timeSlot
     * @return bool
     */
    private function hasTimeSlotOverlap(TimeSlot $timeSlot)
    {
        $slots = $this->getBookedSlots();

        for ($i = 0; $i<sizeof($slots); $i++) {
            if ($slots[$i]->getEndPoint() < $timeSlot->getStartPoint()) {
                if (isset($slots[$i+1])) {
                    if ($slots[$i+1]->getStartPoint() > $timeSlot->getEndPoint()) {
                        return false;
                    } else {
                    return true;
                    }
                } else {
                    return false;
                }
            } else {
                return true;
            }
        }

    }
}