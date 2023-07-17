<?php

namespace Models;

use PHPUnit\Framework\TestCase;
//use Models\Connect;
use PDO;

include 'config/const.php';

class TaskTest extends TestCase
{
    private $task;
    private $connect;
    private $path;
 
    protected function setUp(): void
    {
        $this->task = new Task();
        $this->connect = new Connect();
        $this->path = trim(PATH_CONF, '/');
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

    public function testReturnTypeLoadTasksData(): void
    {
        $result = $this->task->loadTasksData($this->connect, $this->path);
        $this->assertIsArray($result, $message = 'not array');
    }

    public function testGetCountPages(): void
    {
        $result['count'] = $this->task->getCountPages($this->connect, $this->path);
        $this->assertContainsOnly('int', $result);
    }

    public function testReturnTypeLoadTasksForPagination(): void
    {
        $page = rand(0, $this->task->getCountPages($this->connect, $this->path));
        $result = $this->task->loadTasksForPagination($this->connect, $page, $this->path);
        $this->assertIsArray($result, $message = 'not array');
    }

    public function testCountResultsLoadTasksForPagination():void
    {
        $page = rand(0, $this->task->getCountPages($this->connect, $this->path));
        $result = $this->task->loadTasksForPagination($this->connect, $page, $this->path);
        $this->assertCount(3, $result);
    }

    public function testLoadOneTaskData(): void
    {
        $max = 0;
        $result = $this->task->loadTasksData($this->connect, $this->path);
        foreach($result as $task) {
            if ($task['id'] > $max) {
                $max = $task['id'];
            }
        }
        $id = rand(0, $max);
        $result = $this->task->loadOneTaskData($this->connect, $id, $this->path);
        $this->assertCount(1, $result);
    }
}
