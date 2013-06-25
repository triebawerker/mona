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
}