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
