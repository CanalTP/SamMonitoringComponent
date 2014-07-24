<?php

namespace CanalTP\SamMonitoringComponent\Test\Component;

class ComponentTest extends \PHPUnit_Framework_TestCase
{
    private $component;
    private $manager;
    
    public function setUp()
    {
        $this->component = new \CanalTP\SamMonitoringComponent\Test\Data\ComponentMock('test');
        $this->manager = new \CanalTP\SamMonitoringComponent\Manager();
    }
    
    public function testCheckMethod()
    {
        $this->manager->addComponent($this->component);
        
        $service = new \CanalTP\SamMonitoringComponent\Test\Data\ServiceMock('test');
        $this->assertEquals($service->getState(), \CanalTP\SamMonitoringComponent\StateMonitorInterface::DOWN);
        
        $this->manager->addService($service, 'test', 'ytreza');
        $this->manager->getComponent('test')->check();
        
        $this->assertEquals($service->getState(), \CanalTP\SamMonitoringComponent\StateMonitorInterface::UP);
    }
    
    public function testName()
    {
        $name = 'componentName';
        $this->component->setName($name);
        
        $this->assertEquals($this->component->getName(), $name);
    }
}
