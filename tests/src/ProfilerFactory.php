<?php

namespace SimpleProfiler;

use SimpleProfiler\Listener\ListenerInterface;

class ProfilerFactory
{
    /**
     * @param ListenerInterface[] $listeners
     * @return Profiler
     */
    public static function create($listeners)
    {
        $profiler = new Profiler();
        array_walk($listeners, function (ListenerInterface $listener) use ($profiler) {
            $profiler->addListener($listener);
        });
        return $profiler;
    }
}