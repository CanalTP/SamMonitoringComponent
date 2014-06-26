<?php

namespace CanalTP\SamMonitoringComponent\Test\Category;

class CategoryTest extends \PHPUnit_Framework_TestCase
{
    private $category;
    
    public function setUp()
    {
        $this->category = new \CanalTP\SamMonitoringComponent\Category\CategoryMonitor();
    }
    
    public function testGetSetName()
    {
        $category = new \CanalTP\SamMonitoringComponent\Category\CategoryMonitor('test');
        $this->assertEquals($category->getName(), 'test');
        
        $category->setName('canaltp');
        $this->assertEquals($category->getName(), 'canaltp');
    }
    
    public function testGetSetService()
    {
        $s1 = new \CanalTP\SamMonitoringComponent\Test\Data\ServiceMock('Stest1');
        $s2 = new \CanalTP\SamMonitoringComponent\Test\Data\ServiceMock('Stest2');
        $s3 = new \CanalTP\SamMonitoringComponent\Test\Data\ServiceMock('Stest3');
        
        $category = new \CanalTP\SamMonitoringComponent\Category\CategoryMonitor('Ctest');
        
        $category->addService($s1);
        $category->addService($s3);
        $category->addService($s2);
        
        $this->assertCount(3, $category->getServices());
        
    }
}
