<?php

namespace CanalTP\SamMonitoringComponent\Component;

use CanalTP\SamMonitoringComponent\StateMonitorInterface as State;
use CanalTP\SamMonitoringComponent\Category\CategoryMonitorInterface;

abstract class AbstractComponentMonitor implements ComponentMonitorInterface
{
    protected $name = null;
    protected $state = null;
    protected $categories = null;

    public function __construct()
    {
        $this->name = 'Unknown';
        $this->state = State::UNKNOWN;
        $this->categories = array();
    }

    public function getName()
    {
        return ($this->name);
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getState()
    {
        return ($this->state);
    }

    public function setState(State $state)
    {
        $this->state = $state;
    }

    public function addCategory(CategoryMonitorInterface $category)
    {
        $this->categories[$category->getName()] = $category;
    }

    public function getCategories()
    {
        return ($this->categories);
    }
    
    public function getCategoryByName($categoryName)
    {
        if (!isset($this->categories[$categoryName])) {
            $newCategory = new \CanalTP\SamMonitoringComponent\Category\CategoryMonitor($categoryName);
            $this->categories[$categoryName] = $newCategory; 
        }
        
        return $this->categories[$categoryName];
    }
}
