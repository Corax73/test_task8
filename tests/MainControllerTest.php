<?php

namespace Controllers;

use PHPUnit\Framework\TestCase;
use Models\InputCleaning;

include 'config/const.php';

class MainControllerTest extends TestCase
{
    private $controller;
 
    protected function setUp(): void
    {
        $this->controller = new MainController();
    }
 
    protected function tearDown(): void
    {
        $this->controller = NULL;
    }

    public function testCreateRouter(): void
    {
        $this->assertContainsOnlyInstancesOf(
            MainController::class,
            [new MainController, new InputCleaning]
        );
    }
}
