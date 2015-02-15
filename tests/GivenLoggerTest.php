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
        $this->assertLogContains($expectedLogContent);
    }

    public function provideLoggers()
    {
        return array(
            array('csv', "Hello,World\n"),
            array('json', '["Hello","World"]' . "\n"),
        );
    }

    /** @dataProvider provideMultiRows */
    public function testShouldAppendsLinesInOneFileOperation(array $rows, $expectedLogContent)
    {
        appendCsvLines($this->testLog, $rows);
        $this->assertLogContains($expectedLogContent);
    }

    public function provideMultiRows()
    {
        return array(
            'no rows -> no file content' => array(array(), ""),
            'N rows -> N lines' => array(
                array(array(1, 'one'), array(2, 'two')),
                "1,one\n2,two\n"
            )
        );
    }

    public function testWhenLogIsClearedThenFileShouldBeEmpty()
    {
        file_put_contents($this->testLog, 'irrelevant existing content');
        clearLog($this->testLog);
        $this->assertLogContains(emptyString());
    }

    private function assertLogContains($expectedContent)
    {
        assertThat(file_get_contents($this->testLog), is($expectedContent));
    }

    public function tearDown()
    {
        if (file_exists($this->testLog)) {
            unlink($this->testLog);
        }
    }
}
