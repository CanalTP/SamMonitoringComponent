<?php

namespace CanalTP\SamMonitoringComponent\Test\Service\Database;

class PgsqlTest extends \PHPUnit_Framework_TestCase
{
    private $component;
    private $manager;
    
    public function setUp()
    {
        $this->component = new \CanalTP\SamMonitoringComponent\Test\Data\ComponentMock('CompTest');
        $this->manager = new \CanalTP\SamMonitoringComponent\Manager();
    }
    
    public function testCheckMethodOk()
    {
        $this->manager->addComponent($this->component);
        
        $service = new \CanalTP\SamMonitoringComponent\Test\Data\Service\Database\PgsqlMock(true);
        $this->assertEquals($service->getState(), \CanalTP\SamMonitoringComponent\StateMonitorInterface::UNKNOWN);
        
        $this->manager->addService($service, 'CompTest', 'CatTest');
        $this->manager->getComponent('CompTest')->check();
        
        
        $this->assertEquals($service->getState(), \CanalTP\SamMonitoringComponent\StateMonitorInterface::UP);
    }
    
    public function testCheckMethodKo()
    {
        $this->manager->addComponent($this->component);
        
        $service = new \CanalTP\SamMonitoringComponent\Test\Data\Service\Database\PgsqlMock(false);
        $this->assertEquals($service->getState(), \CanalTP\SamMonitoringComponent\StateMonitorInterface::UNKNOWN);
        
        $this->manager->addService($service, 'CompTest', 'CatTest');
        $this->manager->getComponent('CompTest')->check();
        
        
        $this->assertEquals($service->getState(), \CanalTP\SamMonitoringComponent\StateMonitorInterface::DOWN);
    }
}
