<?php

namespace ProfilerTools;

function createLogger($log, $format = 'csv')
{
    return function (array $data) use ($log, $format) {
        if ($format == 'csv') {
            appendCsv($log, $data);
        } else {
            appendJson($log, $data);
        }
    };
}

function appendCsv($log, array $data)
{
    appendLine($log, implode(',', $data));
}

function appendJson($log, array $data)
{
    appendLine($log, json_encode($data));
}

function appendLine($log, $lineContent)
{
    file_put_contents($log, "{$lineContent}\n", FILE_APPEND);
}

function clearLog($log)
{
    file_put_contents($log, '');
}
