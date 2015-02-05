<?php

namespace ProfilerTools;

function stopwatch()
{
    $startDate = new \DateTime();
    $start = microtime(true);
    return function () use ($startDate, $start) {
        return array(
            $startDate,
            new \DateTime(),
            microtime(true) - $start
        );
    };
}

function monitorExecution(callable $function)
{
    $report = new ExecutionReport();
    $stopwatch = stopwatch();
    $function();
    list($report->dateStart, $report->dateFinish, $report->elapsedSeconds) = $stopwatch();
    return $report;
}
