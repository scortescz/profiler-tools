<?php

namespace ProfilerTools;

function secondsToDays($seconds, $precision = 1)
{
    return secondsToReadableFormat(
        $seconds,
        'z H i s',
        array('d', 'h', 'm', 's'),
        ' ',
        $precision
    );
}

function secondsToReadableFormat($seconds, $dateFormat, $units, $separator, $precision)
{
    $date = gmdate($dateFormat, $seconds);
    $dates = array_map('intval', explode($separator, $date));
    $dates[count($dates) - 1] .= getDecimalPart($seconds, $precision);
    $nonZeroDates = array_filter($dates, 'ProfilerTools\greaterThatZero');
    if ($nonZeroDates) {
        $datesWithUnits = addUnits($nonZeroDates, $units);
        return implode($datesWithUnits, $separator);
    }
    return getZeroSeconds($units);
}

function getDecimalPart($seconds, $precision)
{
    if (isDecimal($seconds) && $precision > 0) {
        $numbers = explode('.', round($seconds, $precision));
        if (isset($numbers[1])) {
            return '.' . $numbers[1];
        }
    }
    return '';
}

function isDecimal($number)
{
    return is_float($number) && floor($number) != $number;
}

function greaterThatZero($number)
{
    return $number > 0;
}

function addUnits($values, $units)
{
    return array_map(
        function ($value, $unit) {
            return "{$value}{$unit}";
        },
        $values,
        array_intersect_key($units, $values)
    );
}

function getZeroSeconds($units)
{
    return '0' . end($units);
}
