<?php

namespace ivol\profiler;

use ivol\profiler\Event\Event;
use ivol\profiler\Listener\ListenerInterface;

class Profiler
{
    /** @var TimerListenerInterface[] */
    private static $listeners = [];
    private static $timers = [];
    private static $counters = [];

    public static function addListener(ListenerInterface $listener)
    {
        self::$listeners[spl_object_hash($listener)] = $listener;
    }

    public static function removeListener(ListenerInterface $listener)
    {
        unset(self::$listeners[spl_object_hash($listener)]);
    }

    public static function fire(Event $event)
    {
        array_walk(self::$listeners, function (ListenerInterface $listener) use ($event) {
            if($listener->isSupported($event)) {
                $listener->listen($event);
            }
        });
    }

}