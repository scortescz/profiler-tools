<?php

namespace ProfilerTools;

class GivenStopwatchTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldReturnDatesAndElapsedSeconds()
    {
        $stopwatch = stopwatch();
        usleep(100000);
        list($start, $end, $elapsedSeconds) = $stopwatch();
        assertThat($start, anInstanceOf('Datetime'));
        assertThat($end, anInstanceOf('Datetime'));
        assertThat($elapsedSeconds, greaterThanOrEqualTo(0.1));
    }

    public function testDifferentStopwatchesDoNotShareState()
    {
        $firstStopwatch = stopwatch();
        usleep(100);
        $secondStopwatch = stopwatch();
        assertThat(
            $this->getElapsedSeconds($firstStopwatch),
            not($this->getElapsedSeconds($secondStopwatch))
        );
    }

    private function getElapsedSeconds(callable $stopwatch)
    {
        list($start, $end, $elapsedSeconds) = $stopwatch();
        return $elapsedSeconds;
    }
}
