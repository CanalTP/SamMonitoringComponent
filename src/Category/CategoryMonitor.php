<?php

namespace CanalTP\SamMonitoringComponent\Category;

use CanalTP\SamMonitoringComponent\Service\ServiceMonitorInterface;

class CategoryMonitor implements CategoryMonitorInterface
{
    protected $name = null;
    protected $services = null;

    public function __construct($name = 'Unknown')
    {
        $this->name = $name;
        $this->services = array();
    }

    public function getName()
    {
        return ($this->name);
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function addService(ServiceMonitorInterface $service)
    {
        $this->services[] = $service;
    }

    public function getServices()
    {
        return ($this->services);
    }

    public function check()
    {
        foreach ($this->services as $service) {
            $service->check();
        }
    }
}
