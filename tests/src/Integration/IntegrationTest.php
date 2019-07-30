<?php
namespace SimpleProfiler\Integration;

use SimpleProfiler\Listener\StreamOutputListener;
use SimpleProfiler\Profiler;
use SimpleProfiler\Timer;

class IntegrationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @group integration
     */
    public function timer()
    {
        Profiler::addListener(new StreamOutputListener(fopen('php://stdout', 'w')));
        $timerObject = new TimerTestObject();
        $timerObject->implicitWaitWithMemoryEating();
    }
}

class TimerTestObject {
    public function implicitWaitWithMemoryEating()
    {
        $timer = Timer::start("Test timer");
        $matrix = $this->zeros(795,6942);
        sleep(10);
        $timer->stop();
    }

    private function zeros($rowCount, $colCount){
        $matrix = array();
        for ($rowIndx=0; $rowIndx<$rowCount; $rowIndx++){
            $matrix[] = array();
            for($colIndx=0; $colIndx<$colCount; $colIndx++){
                $matrix[$rowIndx][$colIndx]=0;
            }
        }
        return $matrix;
    }
}