<?php

namespace ProfilerTools;

class GivenStopwatchTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldReturnDatesAndElapsedSeconds()
    {
        $stopwatch = stopwatch();
        usleep(100000);
        list($start, $end, $elapsedSeconds) = $stopwatch();
        $this->assertTrue($start instanceof \DateTime);
        $this->assertTrue($end instanceof \DateTime);
        $this->assertGreaterThanOrEqual(0.1, $elapsedSeconds);
    }

    public function testDifferentStopwatchesDoNotShareState()
    {
        $firstStopwatch = stopwatch();
        usleep(100);
        $secondStopwatch = stopwatch();
        $this->assertNotEquals(
            $this->getElapsedSeconds($firstStopwatch),
            $this->getElapsedSeconds($secondStopwatch)
        );
    }

    private function getElapsedSeconds(callable $stopwatch)
    {
        list($start, $end, $elapsedSeconds) = $stopwatch();
        return $elapsedSeconds;
    }
}
