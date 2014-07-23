<?php

namespace CanalTP\SamMonitoringComponent\Service;

use CanalTP\SamMonitoringComponent\StateMonitorInterface as State;

abstract class AbstractServiceMonitor implements ServiceMonitorInterface
{
    protected $name = null;
    protected $state = null;
    protected $categories = null;
    protected $message = '';

    public function __construct()
    {
        $this->name = 'Unknown';
        $this->state = State::UNKNOWN;
        $this->message = 'No message';
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

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getMessage()
    {
        return ($this->message);
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }
}
