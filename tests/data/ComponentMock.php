<?php

namespace CanalTP\SamMonitoringComponent\Test\Data;

use CanalTP\SamMonitoringComponent\StateMonitorInterface as State;
use CanalTP\SamMonitoringComponent\Component\AbstractComponentMonitor;

class ComponentMock extends AbstractComponentMonitor
{
    public function __construct($name, $state = State::DOWN)
    {
        parent::__construct();
        $this->name = $name;
        $this->state = $state;
        $this->categories = array();
    }
}