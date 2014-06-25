<?php

namespace CanalTP\SamMonitoringComponent;

class Manager
{
    protected $components = array();
    
    public function __construct()
    {
    }
    
    public function addComponent($component, $appName = null) 
    {
        $name = strtolower($appName);
        if (is_null($name)) {
            $name = strtolower($component->getName());
        }
        
        if (isset($this->components[$name])) {
            throw new MonitoringException('Monitoring component for "' . $name . '" already set.');
        }
        $this->components[$name] = $component;
    }
    
    public function hasComponent($application)
    {
        if (isset($this->components[$application])) {
            return true;
        }
        
        return false;
    }
    
    public function addService($service, $application, $category)
    {
        if (!isset($this->components[strtolower($application)])) {
            throw new MonitoringException('Monitoring component for "' . $application . '" not exist.');
        }
        
        $component = $this->components[strtolower($application)];
        $category = $component->getCategoryByName($category);
        $category->addService($service);
    }
}
