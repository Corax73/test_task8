<?php

namespace Controllers;

use Views\View;
use Models\Task;
use Models\Connect;
use Models\InputCleaning;

class MainController
{
    /**
     * handles the homepage request
     * @param int $page
     * @return void
     */
    public function index(int $page):void
    {
        $task = new Task();
        $conn = new Connect();
        $tasks = $task->loadTasksForPagination($conn, $page);
        $countPage = $task->getCountPages($conn);
        $view = new View;
        $view->render($tasks, $countPage);
    }

    /**
     * creates a task based on user input
     * @return void
     */
    public function create():void
    {
        if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['descriptions'])) {
            $cleaning = new InputCleaning();
            
            $username = $cleaning->clean($_POST['username']);
            $email = $cleaning->clean($_POST['email']);
            $descriptions = $cleaning->clean($_POST['descriptions']);
    
            $task = new Task();
            $conn = new Connect();
    
            $task->saveTask($conn, $username, $email, $descriptions);
            header ("Location: http://localhost:8000");
        }
    }
}
