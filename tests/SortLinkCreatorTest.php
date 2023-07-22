<?php

namespace Models;

use PHPUnit\Framework\TestCase;
 
class SortLinkCreatorTest extends TestCase
{
    private $sortLinkCreator;
 
    protected function setUp(): void
    {
        $this->sortLinkCreator = new SortLinkCreator();
    }
 
    protected function tearDown(): void
    {
        $this->sortLinkCreator = NULL;
    }

    public function testCreateSortLinkCreatorTest(): void
    {
        $this->assertContainsOnlyInstancesOf(
            SortLinkCreatorTest::class,
            [new Connect, new SortLinkCreatorTest]
        );
    }

    public function testCreatingSortLinks(): void
    {
        $_SERVER['REQUEST_URI'] = 'http://localhost:8000/0/sort=TestField_asc';
        $result = $this->sortLinkCreator->creatingSortLinks('TestField', 'TestField_asc', 'TestField_desc', 2);
        $this->assertEquals($result, '<a class="active" href="http://localhost:8000/2/sort=TestField_desc">TestField <i>▲</i></a>');
    }

    public function testCreatingSortLinksForAdmin(): void
    {
        $_SERVER['REQUEST_URI'] = 'http://localhost:8000/0/sort=TestField_asc';
        $result = $this->sortLinkCreator->creatingSortLinksForAdmin('TestField', 'TestField_asc', 'TestField_desc', 3);
        $this->assertEquals($result, '<a class="active" href="http://localhost:8000/admin/3/sort=TestField_desc">TestField <i>▲</i></a>');
    }
}
