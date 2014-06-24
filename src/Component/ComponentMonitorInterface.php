<?php

namespace CanalTP\SamMonitoringComponent\Component;

use CanalTP\SamMonitoringComponent\StateMonitorInterface as State;
use CanalTP\SamMonitoringComponent\Category\CategoryMonitorInterface;

interface ComponentMonitorInterface
{
    public function getName();
    public function setName($name);

    public function getState();
    public function setState(State $state);

    public function getCategories();
    public function addCategory(CategoryMonitorInterface $category);

    public function check();
}
