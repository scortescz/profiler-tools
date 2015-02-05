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

    public function convertSecondsToReadableString()
    {
        return secondsToDays($this->elapsedSeconds);
    }
}
