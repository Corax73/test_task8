<?php

namespace Models;

use PHPUnit\Framework\TestCase;
use Models\Connect;
use PhpParser\Builder\Param;

include 'config/const.php';

class TaskTest extends TestCase
{
    private $task;
    private $connect;
 
    protected function setUp(): void
    {
        $this->task = new Task();
        $this->connect = new Connect();
    }
 
    protected function tearDown(): void
    {
        $this->task = NULL;
        $this->connect = NULL;
    }

    public function testCreateTask(): void
    {
        $this->assertContainsOnlyInstancesOf(
            Task::class,
            [new Connect, new Task]
        );
    }
}
