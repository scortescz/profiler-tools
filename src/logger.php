<?php

namespace ProfilerTools;

function appendCsvLine($log, array $row)
{
    appendCsvLines($log, array($row));
}

function appendCsvLines($log, array $rows)
{
    $lines = array_reduce(
        $rows,
        function ($previousLines, array $row) {
            return $previousLines . implode(',', $row) . "\n";
        },
        ''
    );
    file_put_contents($log, $lines, FILE_APPEND);
}

function clearLog($log)
{
    file_put_contents($log, '');
}
