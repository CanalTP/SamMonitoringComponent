<?php

namespace CanalTP\SamMonitoringComponent\Test\Data;

use CanalTP\SamMonitoringComponent\StateMonitorInterface as State;
use CanalTP\SamMonitoringComponent\Service\AbstractServiceMonitor;

class ServiceMock extends AbstractServiceMonitor
{
    public function __construct($name, $state = State::DOWN, $message = 'Nothing')
    {
        parent::__construct();
        $this->name = $name;
        $this->state = $state;
        $this->message = $message;
    }

    public function check()
    {
        $this->state = State::UP;
    }

}
