<?php
namespace SimpleProfiler;

use SimpleProfiler\Event\Event;
use SimpleProfiler\Event\TimerEvent;
use SimpleProfiler\Listener\ListenerInterface;

class ProfilerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    function fireHandleProperListeners()
    {
        $profiler = ProfilerFactory::create([
            $this->createListener(true),
            $this->createListener(false)
        ]);

        $profiler->fire(new TimerEvent("test", 0, 0, 0));
    }

    private function createListener($isSupported)
    {
        $listener = $this->getMock(ListenerInterface::class);
        $listener->expects($isSupported ? $this->once() : $this->never())->method('listen')
            ->with($this->isInstanceOf(Event::class));
        $listener->expects($this->any())->method('isSupported')->will($this->returnValue($isSupported));
        return $listener;
    }
}



