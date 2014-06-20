<?php

namespace CanalTP\SamMonitoringComponent\Category;

use CanalTP\SamMonitoringComponent\Service\ServiceMonitorInterface;

abstract class AbstractCategoryMonitor implements CategoryMonitorInterface
{
    protected $name = null;
    protected $services = null;

    public function __construct()
    {
        $this->name = 'Unknown';
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
}
