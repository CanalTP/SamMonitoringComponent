<?php

namespace CanalTP\SamMonitoringComponent;

class Manager
{
    protected $components = array();
    
    public function __construct()
    {
    }
    
    public function addComponent(Component\ComponentMonitorInterface $component, $appName = null) 
    {
        if (is_null($appName)) {
            $name = strtolower($component->getName());
        } else {
            $name = strtolower($appName);
        }
        
        if (isset($this->components[$name])) {
            throw new MonitoringException('Monitoring component for "' . $name . '" already set.');
        }
        
        $this->components[$name] = $component;
    }
    
    public function hasComponent($application)
    {
        if (isset($this->components[strtolower($application)])) {
            return true;
        }
        
        return false;
    }
    
    public function getComponent($application)
    {
        if (isset($this->components[strtolower($application)])) {
            return $this->components[strtolower($application)];
        }
        
        return null;
    }
    
    public function addService(Service\ServiceMonitorInterface $service, $application, $category)
    {
        if (!isset($this->components[strtolower($application)])) {
            throw new MonitoringException('Monitoring component for "' . $application . '" not exist.');
        }
        
        $component = $this->components[strtolower($application)];
        $category = $component->getCategoryByName($category);
        $category->addService($service);
    }
}
