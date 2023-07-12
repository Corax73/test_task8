<?php

namespace Controllers;

use Models\InputCleaning;
use Models\User;
use Models\Connect;
use Views\View;
use Models\Task;

class AdminController
{
    public function edit()
    {
        print 'admincontroller work';
    }

    public function login():void
    {
        if(!empty($_POST['login']) && !empty($_POST['passwordForLogin'])) {
            $cleaning = new InputCleaning();
        
            $login = $cleaning->clean($_POST['login']);
            
            $password = $_POST['passwordForLogin'];
            $conn = new Connect();
            $user = new User();
            $auth = $user->authUser($conn, $login, $password);
            if ($auth) {
                header("Location: http://localhost:8000/");
            } else {
                $error['auth'] = 'Authentication failed';
                $page = 0;
                $sort = explode('=', $_SERVER['REQUEST_URI']);
                $sort = $sort[0];
                $task = new Task();
                $conn = new Connect();
                $tasks = $task->loadTasksForPagination($conn, $page);
                $countPage = $task->getCountPages($conn);
                $view = new View;
                $view->renderPublic($tasks, $countPage, $sort, $page, $error);
            }
        }
    }

    public function logout():void
    {
        $user = new User();
        $user->logout();
    }
}
