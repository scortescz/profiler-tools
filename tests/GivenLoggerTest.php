<?php

namespace ProfilerTools;

class GivenLoggerTest extends \PHPUnit_Framework_TestCase
{
    private $testLog;

    public function setUp()
    {
        $this->testLog = __DIR__ . "/test.log";
    }

    /** @dataProvider provideLoggers */
    public function testShouldAppendLineToFile($format, $expectedLogContent)
    {
        $logger = createLogger($this->testLog, $format);
        $logger(array('Hello', 'World'));
        $this->assertEquals($expectedLogContent, file_get_contents($this->testLog));
    }

    public function provideLoggers()
    {
        return array(
            array('csv', "Hello,World\n"),
            array('json', '["Hello","World"]' . "\n"),
        );
    }

    public function testWhenLogIsClearedThenFileShouldBeEmpty()
    {
        file_put_contents($this->testLog, 'irrelevant existing content');
        clearLog($this->testLog);
        $this->assertEmpty(file_get_contents($this->testLog));
    }

    public function tearDown()
    {
        if (file_exists($this->testLog)) {
            unlink($this->testLog);
        }
    }
}
