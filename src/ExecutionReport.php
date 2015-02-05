<?php

namespace ProfilerTools;

class ExecutionReport
{
    /** @var \DateTime */
    public $dateStart;
    /** @var \DateTime */
    public $dateFinish;
    /** @var float */
    public $elapsedSeconds;
    /** @var \Exception */
    public $exception;

    public function convertSecondsToReadableString()
    {
        return secondsToDays($this->elapsedSeconds);
    }
}
