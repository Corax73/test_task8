<?php

namespace Views;

class View
{
    public function render($data, $countPages)
    {
        $title = 'Work';
        require 'layouts/main-layout.php';
    }
}
