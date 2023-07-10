<?php

namespace Controllers;

use Views\View;
use Models\Task;
use Models\Connect;

class MainController
{
    public function index($page)
    {
        $task = new Task();
        $conn = new Connect();
        $tasks = $task->loadTasksForPagination($conn, $page);
        $countPage = ceil(count($task->loadTasksData($conn))/3);
        $view = new View;
        $view->render($tasks, $countPage);
    }
}
