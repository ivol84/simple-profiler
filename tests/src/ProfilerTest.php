<?php
namespace ivol\tests;


use ivol\profiler\Event\Event;
use ivol\profiler\Event\TimerEvent;
use ivol\profiler\Listener\ListenerInterface;
use ivol\profiler\Profiler;

class ProfilerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    function fireHandleProperListeners()
    {
        Profiler::addListener($this->createListener(true));
        Profiler::addListener($this->createListener(false));

        Profiler::fire(new TimerEvent("test", 0, 0));
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



