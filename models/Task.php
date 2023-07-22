<?php

namespace Models;

use PDO;

class Task
{
    /**
     * downloading data of all tasks
     * @param Connect $connect
     * @param string $path
     * @return array
     */
    public function loadTasksData(Connect $connect, string $path):array
    {
        $query = 'SELECT * FROM `tasks`';
        $stmt = $connect->connect($path)->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    /**
     * output of tasks for pagination
     * @param Connect $connect
     * @param int $page
     * @param string $path
     * @return array
     */
    public function loadTasksForPagination(Connect $connect, int $page, string $path):array
    {
        $start = 0;
        $tasksPerPage = 3;
        if($page != 0){
            $start = ($page - 1) * $tasksPerPage;
        }
        $query = "SELECT * FROM `tasks` LIMIT :start,:tasksPerPage";
        $stmt = $connect->connect($path)->prepare($query);
        $stmt->bindValue(':start', (int) $start, PDO::PARAM_INT);
        $stmt->bindValue(':tasksPerPage', (int) $tasksPerPage, PDO::PARAM_INT);
        $stmt->execute();
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return($tasks);
    }
    
    /**
     * loading data of one task
     * @param Connect $connect
     * @param int $id
     * @param string $path
     * @return array
     */
    public function loadOneTaskData(Connect $connect, int $id, string $path):array
    {
        $query = 'SELECT * FROM `tasks` WHERE `id` = :id';
        $params = [
            ':id' => $id
        ];
        $stmt = $connect->connect($path)->prepare($query);
        $stmt->execute($params);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
    
    /**
     * save task data
     * @param Connect $connect
     * @param string $login
     * @param string $email
     * @param string $descriptions
     * @param string $path
     * @return bool
     */
    public function saveTask(Connect $connect, string $username, string $email, string $descriptions, string $path):bool
    {
        $query = 'INSERT INTO `tasks` (username, email, descriptions) VALUES (:username, :email, :descriptions)';
        $params = [
            ':username' => $username,
            ':email' => $email,
            ':descriptions' => $descriptions
        ];
        $stmt = $connect->connect($path)->prepare($query);
        $stmt->execute($params);
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * sets the execution mark of the task
     * @param Connect $connect
     * @param int $task_id
     * @param int $implementation
     * @param string $path
     * @return bool
     */
    public function setImplementation(Connect $connect, int $task_id, int $implementation, string $path):bool
    {
        $query = 'UPDATE `tasks` SET `implementation` = :implementation WHERE `id` = ' . $task_id;
        $stmt = $connect->connect($path)->prepare($query);
        $params = [
            ':implementation' => $implementation
        ];
        $stmt->execute($params);
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * calculates the number of pages to paginate
     * @param Connect $connect
     * @param string $path
     * @return int
     */
    public function getCountPages(Connect $connect, string $path):int
    {
        $countPage = intval(ceil(count($this->loadTasksData($connect, $path))/3));
        return $countPage;
    }

    /**
     * output tasks for pagination with sorting
     * @param Connect $connect
     * @param int $page
     * @param string $sort
     * @param string $path
     * @return array
     */
    public function loadTasksForPaginationWithSort(Connect $connect, int $page, string $sort, string $path):array
    {
        $sort_list = array(
            'id' => '`id`',
            'username_asc'   => '`username`',
            'username_desc'  => '`username` DESC',
            'email_asc'  => '`email`',
            'email_desc' => '`email` DESC',
            'descriptions_asc'   => '`descriptions`',
            'descriptions_desc'  => '`descriptions` DESC',
            'implementation_asc'   => '`implementation`',
            'implementation_desc'  => '`implementation` DESC'
        );

        if (array_key_exists($sort, $sort_list)) {
            $sort_sql = $sort_list[$sort];
        } else {
            $sort_sql = reset($sort_list);
        }

        $start = 0;
        $tasksPerPage = 3;
        if($page != 0){
            $start = ($page - 1) * $tasksPerPage;
        }

        $query = "SELECT * FROM `tasks` ORDER BY " . $sort_sql . " LIMIT :start,:tasksPerPage";
        $stmt = $connect->connect($path)->prepare($query);
        $stmt->bindValue(':start', (int) $start, PDO::PARAM_INT);
        $stmt->bindValue(':tasksPerPage', (int) $tasksPerPage, PDO::PARAM_INT);
        $stmt->execute();
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return($tasks);
    }

    /**
     * updates task data
     * @param Connect $connect
     * @param array $newData
     * @param int $task_id
     * @param string $path
     * @return bool
     */
    public function updateTask(Connect $connect, array $newData, int $task_id, string $path):bool
    {
        $keys = array_keys($newData);
        $query = 'UPDATE `tasks` SET ';
        $params = [];
        foreach ($keys as $key) {
            $query .= '`' . $key . '` = :' . $key . ', ';
            $params[':' . $key] = $newData[$key];
        }
        $query = mb_substr($query, 0, -2);
        $query .= ' WHERE `id` = ' . $task_id;

        $stmt = $connect->connect($path)->prepare($query);
        $stmt->execute($params);
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }
}
