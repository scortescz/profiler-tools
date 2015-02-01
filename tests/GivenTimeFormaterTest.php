<?php

namespace ProfilerTools;

class GivenTimeFormaterTest extends \PHPUnit_Framework_TestCase
{
    /** @dataProvider provideSeconds */
    public function testShouldConvertSecondsToReadableString($seconds, $precision, $expectedString)
    {
        $this->assertEquals(
            $expectedString,
            secondsToDays($seconds, $precision)
        );
    }

    public function provideSeconds()
    {
        return array(
            array(0.1562, 2, '0.16s'),
            array(65, 2, '1m 5s'),
            array(86922.2, 1, '1d 8m 42.2s'),
            array(12805.9, 0, '3h 33m 25s'),
        );
    }
}
