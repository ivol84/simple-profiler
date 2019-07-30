<?php
namespace ivol\profiler\Event;

class TimerEvent extends Event
{
    /** @var int */
    private $totalTime;
    /** @var int */
    private $memoryUsage;

    /**
     * TimerEvent constructor.
     * @param $totalTime
     * @param $memoryUsage
     */
    public function __construct($name, $totalTime, $memoryUsage)
    {
        parent::__construct($name);
        $this->totalTime = $totalTime;
        $this->memoryUsage = $memoryUsage;
    }

    /**
     * @return int
     */
    public function getTotalTime()
    {
        return $this->totalTime;
    }

    /**
     * @return int
     */
    public function getMemoryUsage()
    {
        return $this->memoryUsage;
    }
}