<?php

namespace Controllers;

use PHPUnit\Framework\TestCase;
use Models\InputCleaning;

include 'config/const.php';

class AdminControllerTest extends TestCase
{
    private $controller;
 
    protected function setUp(): void
    {
        $this->controller = new AdminController();
    }
 
    protected function tearDown(): void
    {
        $this->controller = NULL;
    }

    public function testCreateRouter(): void
    {
        $this->assertContainsOnlyInstancesOf(
            AdminController::class,
            [new AdminController, new InputCleaning]
        );
    }
}
