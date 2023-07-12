<?php

namespace Views;

use \Models\SortLinkCreator;

class View
{
    /**
     * template output with data passing to it
     * @param array $data
     * @param int $countPages
     * @return void
     */
    public function renderPublic(array $data, int $countPages, string $sort, int $page, array $error = []):void
    {
        if (($sort == '/')) {
            $sort = 'id';
        }
        $title = 'Task list';
        $sortLinks = new SortLinkCreator();

        require 'layouts/main-layout.php';
    }
}
