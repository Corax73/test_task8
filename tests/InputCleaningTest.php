<?php

namespace Models;

use PHPUnit\Framework\TestCase;
 
class InputCleaningTest extends TestCase
{
    private $inputCleaning;
 
    protected function setUp(): void
    {
        $this->inputCleaning = new InputCleaning();
    }
 
    protected function tearDown(): void
    {
        $this->inputCleaning = NULL;
    }

    public function testCreateInputCleaning(): void
    {
        $this->assertContainsOnlyInstancesOf(
            InputCleaning::class,
            [new Connect, new InputCleaning]
        );
    }

    public function testReturnType(): void
    {
        $result = $this->inputCleaning->clean(' abc/  ');
        $this->assertSame($result, 'abc/');
    }

    public function testClean(): void
    {
        $result = $this->inputCleaning->clean(' abc/ <br> ');
        $this->assertEquals($result, 'abc/ &lt;br&gt;');
    }
}
