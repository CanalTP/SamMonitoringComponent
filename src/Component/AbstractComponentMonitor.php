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
            $this->addCategory(new \CanalTP\SamMonitoringComponent\Category\CategoryMonitor($categoryName));
        }

        return $this->categories[$categoryName];
    }

    public function check()
    {
        foreach ($this->categories as $categorie) {
            $categorie->check();
        }
    }
}
