<?php

namespace ProfilerTools;

class GivenLoggerTest extends \PHPUnit_Framework_TestCase
{
    private $testLog;

    public function setUp()
    {
        $this->testLog = __DIR__ . "/test.log";
    }

    /** @dataProvider provideRows */
    public function testShouldAppendFileInOneFileOperation($logger, array $data, $expectedLogContent)
    {
        $logger($this->testLog, $data);
        $this->assertLogContains($expectedLogContent);
    }

    public function provideRows()
    {
        return array(
            '1 row with no data -> empty line' => array(
                'ProfilerTools\appendCsvLine',
                array(),
                "\n"
            ),
            '1 row with data -> csv line' => array(
                'ProfilerTools\appendCsvLine',
                array('Hello', 'World'),
                "Hello,World\n"
            ),
            '0 rows -> no file content' => array(
                'ProfilerTools\appendCsvLines',
                array(),
                ""
            ),
            'N rows -> N lines' => array(
                'ProfilerTools\appendCsvLines', 
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
