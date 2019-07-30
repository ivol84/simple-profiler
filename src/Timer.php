<?php
namespace SimpleProfiler;

use SimpleProfiler\Event\TimerEvent;

class Timer
{
    /** @var Profiler */
    private $profiler;
    /** @var float  */
    private $startTime = 0;
    /** @var int  */
    private $memoryPeakUsage = 0;
    /** @var int  */
    private $realMemoryUsage = 0;
    /** @var string */
    private $name;

    /**
     * @param string $name
     * @param Profiler $profiler
     * @return Timer
     */
    public static function start($name, $profiler = null)
    {
        $timer = new Timer();
        $timer->injectProfiler($profiler);
        $timer->name = $name;
        $timer->startTime = microtime(true);
        $timer->memoryPeakUsage = memory_get_peak_usage(false);
        $timer->realMemoryUsage = memory_get_peak_usage(true);
        return $timer;
    }

    public function stop()
    {
        $this->profiler->fire(new TimerEvent($this->name,
            microtime(true) - $this->startTime,
            memory_get_peak_usage(false) - $this->memoryPeakUsage,
            memory_get_peak_usage(true) - $this->realMemoryUsage
        ));
    }

    private function injectProfiler($profiler)
    {
        $this->profiler = $profiler ? : Profiler::create();

    }


}