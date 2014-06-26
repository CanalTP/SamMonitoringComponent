<?php

namespace CanalTP\SamMonitoringComponent\Test;

class ManagerTest extends \PHPUnit_Framework_TestCase
{
    private $manager;
    
    public function setUp()
    {
        $this->manager = new \CanalTP\SamMonitoringComponent\Manager();
    }
    
    public function testAddServiceToEmptyManager()
    {
        $this->setExpectedException('CanalTP\SamMonitoringComponent\MonitoringException');
        $service = new Data\ServiceMock('test');
        $this->manager->addService($service, 'azerty', 'ytreza');
    }
    
    public function testAddServiceToManagerWithOneComponent()
    {
        $cp1 = new Data\ComponentMock('test');
        $this->manager->addComponent($cp1);
        
        $service = new Data\ServiceMock('test');
        $this->manager->addService($service, 'test', 'ytreza');
        
        $this->assertCount(1, $cp1->getCategories());
        $this->assertNotNull($cp1->getCategories()['ytreza']);
        $this->assertEquals('ytreza', $cp1->getCategories()['ytreza']->getName());
        $this->assertCount(1, $cp1->getCategories()['ytreza']->getServices());
    }
    
    public function testAddServiceToManagerWithManyComponent()
    {
        $cp1 = new Data\ComponentMock('test');
        $this->manager->addComponent($cp1);
        $cp2 = new Data\ComponentMock('test2');
        $this->manager->addComponent($cp2);
        $cp3 = new Data\ComponentMock('test3');
        $this->manager->addComponent($cp3);
        $cp4 = new Data\ComponentMock('test4');
        $this->manager->addComponent($cp4);
        
        $service = new Data\ServiceMock('test');
        $this->manager->addService($service, 'test3', 'ytreza');
        
        $this->assertCount(0, $cp1->getCategories());
        $this->assertCount(0, $cp2->getCategories());
        $this->assertCount(0, $cp4->getCategories());
        
        $this->assertCount(1, $cp3->getCategories());
        $this->assertNotNull($cp3->getCategories()['ytreza']);
        $this->assertEquals('ytreza', $cp3->getCategories()['ytreza']->getName());
        $this->assertCount(1, $cp3->getCategories()['ytreza']->getServices());
    }
    
    public function testRedefineComponent()
    {
        $this->setExpectedException('CanalTP\SamMonitoringComponent\MonitoringException');
        
        $cp1 = new Data\ComponentMock('test');
        $cp2 = new Data\ComponentMock('test');
        
        $this->manager->addComponent($cp1);
        $this->manager->addComponent($cp2);
    }
    
    public function testComponent()
    {
        $cp1 = new Data\ComponentMock('test');
        $this->manager->addComponent($cp1);
        $this->assertTrue($this->manager->hasComponent('test'));
        $this->assertEquals($cp1, $this->manager->getComponent('test'));
    }
    
    public function testComponentCase()
    {
        $cp1 = new Data\ComponentMock('tESt2');
        $this->manager->addComponent($cp1);
        $this->assertTrue($this->manager->hasComponent('test2'));
        $this->assertEquals($cp1, $this->manager->getComponent('test2'));
    }
    
    public function testNoComponent()
    {
        $this->assertFalse($this->manager->hasComponent('test3'));
        $this->assertNull($this->manager->getComponent('test3'));
    }
    
    public function testComponentWithArgument()
    {
        $cp1 = new Data\ComponentMock('test');
        $this->manager->addComponent($cp1, 'foo');
        $this->assertTrue($this->manager->hasComponent('foo'));
    }
    
    public function testComponentWithArgument2()
    {
        $cp1 = new Data\ComponentMock('test');
        $this->manager->addComponent($cp1, 'foo');
        $this->assertFalse($this->manager->hasComponent('test'));
    }
    
    public function testComponentCaseWithArgument()
    {
        $cp1 = new Data\ComponentMock('test');
        $this->manager->addComponent($cp1, 'FoO');
        $this->assertTrue($this->manager->hasComponent('foo'));
    }
    
    public function testCheckServiceInterface()
    {
        $this->setExpectedException('PHPUnit_Framework_Error');
        $service = new \stdClass();
        $this->manager->addService($service, 'azerty', 'ytreza');
    }
            
    public function testCheckComponentInterface()
    {
        $this->setExpectedException('PHPUnit_Framework_Error');
        $cp1 = new \stdClass();
        $this->manager->addComponent($cp1);
    }
}
