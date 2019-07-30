<?php
namespace SimpleProfiler\Event;

class TimerEvent extends Event
{
    /** @var int */
    private $totalTime;
    /** @var int */
    private $memoryPeakUsage;
    /** @var int */
    private $memoryRealUsage;


    /**
     * TimerEvent constructor.
     * @param string $name
     * @param int $totalTime
     * @param int $memoryPeakUsage
     * @param int $memoryRealUsage
     */
    public function __construct($name, $totalTime, $memoryPeakUsage, $memoryRealUsage)
    {
        parent::__construct($name);
        $this->totalTime = $totalTime;
        $this->memoryPeakUsage = $memoryPeakUsage;
        $this->memoryRealUsage = $memoryRealUsage;
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
    public function getMemoryPeakUsage()
    {
        return $this->memoryPeakUsage;
    }

    /**
     * @return int
     */
    public function getMemoryRealUsage()
    {
        return $this->memoryRealUsage;
    }
}