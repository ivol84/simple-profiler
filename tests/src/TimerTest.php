<?php
namespace SimpleProfiler;


use SimpleProfiler\Event\TimerEvent;

class TimerTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function stopFiresEvent()
    {
        $profiler = $this->getMock(Profiler::class);
        $profiler->expects($this->once())->method('fire')->with(
            $this->callback(function ($event) {
                return $event instanceof TimerEvent && $event->getName() == 'timer1';
            })
        );
        $timer = Timer::start('timer1', $profiler);

        $timer->stop();
    }

}