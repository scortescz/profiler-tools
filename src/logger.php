<?php

namespace ProfilerTools;

function appendCsvLine($log, array $row)
{
    appendCsvLines($log, array($row));
}

function appendCsvLines($log, array $rows)
{
    $lines = array_reduce($rows, 'ProfilerTools\arrayToCsvLine', '');
    file_put_contents($log, $lines, FILE_APPEND);
}

function arrayToCsvLine($accumulator, array $row)
{
    return $accumulator . implode(',', $row) . "\n";
}

function clearLog($log)
{
    file_put_contents($log, '');
}
