# Simple PHP Profiler Tools

Stopwatch, logger and time converter (seconds to readable string).

## Install

Put this in a `composer.json`:

```json
{
    "require": {
        "zdenekdrahos/profiler-tools": "*"
    }
}
```

## Usage

``` php
// start stopwatch
$stopwatch = ProfilerTools\stopwatch();

// execute something

// stop timer
list($start, $end, $elapsedSeconds) = $stopwatch();

// log execution time
$logger = ProfilerTools\createLogger('log.csv');
$logger(array(
    $start->format('c'),
    $end->format('c'),
    ProfilerTools\secondsToDays($elapsedSeconds)
));

```

Logger appends following line to `log.csv`:

```
2015-02-01T09:15:17+01:00,2015-02-01T09:15:18+01:00,1.1s
```

## Stopwatch

* `$stopwatch = ProfilerTools\stopwatch()` - starts timer and returns function for stopping timer
* `$stopwatch()` - returns start/end date and elapsed seconds

## Logger

* `$logger = ProfilerTools\createLogger($file, $format);` - create logger function for selected format (csv or json)
* `$logger(array $data)` - converts data and append the result to file

### Direct loggers

* `appendCsv($file, array $data)`
* `appendJson($file, array $data)`

## Time converter

* `ProfilerTools\secondsToDays($elapsedSeconds, $precision)` - converts seconds to readable format, optional milliseconds precions

### Examples

| Seconds     | .00s         | .0s
| ----------- |--------------|--------------
| 0.1546456   | 0.15s        | 0.2s
| 9           | 9s           | 9s
| 19.7878     | 19.79s       | 19.8s
| 65          | 1m 5s        | 1m 5s
| 374         | 6m 14s       | 6m 14s
| 12805.9     | 3h 33m 25.9s | 3h 33m 25.9s
| 86922.298   | 1d 8m 42.3s  | 1d 8m 42.3s

## License

Copyright (c) 2015 Zdeněk Drahoš. MIT Licensed, see [LICENSE] for details.