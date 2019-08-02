<?php

namespace SimpleProfiler;

use SimpleProfiler\Event\Event;
use SimpleProfiler\Listener\ListenerInterface;

class Profiler
{
    /** @var TimerListenerInterface[] */
    private $listeners = [];

    public static function create()
    {
        return new self();
    }

    public function addListener(ListenerInterface $listener)
    {
        $this->listeners[spl_object_hash($listener)] = $listener;
    }

    public function removeListener(ListenerInterface $listener)
    {
        unset($this->listeners[spl_object_hash($listener)]);
    }

    public function fire(Event $event)
    {
        array_walk($this->listeners, function (ListenerInterface $listener) use ($event) {
            if($listener->isSupported($event)) {
                $listener->listen($event);
            }
        });
    }

}