<?php
namespace SimpleProfiler\Listener;

use SimpleProfiler\Event\Event;
use SimpleProfiler\Event\TimerEvent;

class StreamOutputListener implements TimerListenerInterface
{
    /** @var resource */
    private $stream;

    /**
     * @param resource $stream
     */
    public function __construct($stream)
    {
        $this->stream = $stream;
    }


    /**
     * @param TimerEvent $event
     */
    function listen(Event $event)
    {

        $message = sprintf("Name: %s. Execution time: %f. Peak Memory Usage: %d. Real Memory usage: %d.\n",
            $event->getName(), $event->getTotalTime(), $event->getMemoryPeakUsage(), $event->getMemoryRealUsage());
        fwrite($this->stream, $message);
    }

    /**
     * @param Event $event
     * @return boolean
     */
    function isSupported(Event $event)
    {
        return $event instanceof TimerEvent;
    }
}