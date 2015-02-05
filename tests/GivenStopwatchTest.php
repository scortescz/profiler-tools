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

    public function testShouldMonitorExecution()
    {
        $result = monitorExecution(function() {
            usleep(100000);
        });
        assertThat($result->dateStart, anInstanceOf('Datetime'));
        assertThat($result->dateFinish, anInstanceOf('Datetime'));
        assertThat($result->elapsedSeconds, greaterThanOrEqualTo(0.1));
        assertThat($result->convertSecondsToReadableString(), is('0.1s'));
    }

    private function getElapsedSeconds(callable $stopwatch)
    {
        list($start, $end, $elapsedSeconds) = $stopwatch();
        return $elapsedSeconds;
    }
}
