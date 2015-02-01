<?php

require_once __DIR__ . '/vendor/autoload.php';

// start stopwatch
$stopwatch = ProfilerTools\stopwatch();

// execute something
sleep(1);

// stop timer
list($start, $end, $elapsedSeconds) = $stopwatch();

// log execution time
$logger = ProfilerTools\createLogger('log.csv');
$logger(array(
    $start->format('c'),
    $end->format('c'),
    ProfilerTools\secondsToDays($elapsedSeconds)
));
