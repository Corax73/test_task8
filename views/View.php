<?php

namespace Views;

class View
{
    /**
     * template output with data passing to it
     * @param array $data
     * @param int $countPages
     * @return void
     */
    public function render(array $data, int $countPages, $sort, $page):void
    {
        $title = 'Task list';
        require 'layouts/main-layout.php';
    }
}
