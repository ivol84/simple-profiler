<?php

namespace SimpleProfiler;

use SimpleProfiler\Event\Event;
use SimpleProfiler\Listener\ListenerInterface;

class Profiler
{
    /** @var TimerListenerInterface[] */
    private static $listeners = [];

    public static function create()
    {
        return new self();
    }

    public static function addListener(ListenerInterface $listener)
    {
        self::$listeners[spl_object_hash($listener)] = $listener;
    }

    public static function removeListener(ListenerInterface $listener)
    {
        unset(self::$listeners[spl_object_hash($listener)]);
    }

    public function fire(Event $event)
    {
        array_walk(self::$listeners, function (ListenerInterface $listener) use ($event) {
            if($listener->isSupported($event)) {
                $listener->listen($event);
            }
        });
    }

}