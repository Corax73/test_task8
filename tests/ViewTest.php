<?php

namespace Views;
use Models\InputCleaning;

use PHPUnit\Framework\TestCase;

include 'config/const.php';

class ViewTest extends TestCase
{
    private $view;
 
    protected function setUp(): void
    {
        $this->view = new View();
    }
 
    protected function tearDown(): void
    {
        $this->view = NULL;
    }

    public function testCreateRouter(): void
    {
        $this->assertContainsOnlyInstancesOf(
            View::class,
            [new View, new InputCleaning]
        );
    }
}
