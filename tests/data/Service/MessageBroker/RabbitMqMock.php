<?php

namespace CanalTP\SamMonitoringComponent\Test\Data\Service\MessageBroker;

use CanalTP\SamMonitoringComponent\StateMonitorInterface as State;
use CanalTP\SamMonitoringComponent\Service\AbstractServiceMonitor;

class RabbitMqMock extends \CanalTP\SamMonitoringComponent\Service\MessageBroker\RabbitMq
{
    private $connectionWork = false;
    
    public function __construct($connection)
    {
        parent::__construct('host', 'port', 'vhost', 'login', 'password');
        
        $this->connectionWork = $connection;
    }
    
    protected function checkConnection()
    {
        if (!$this->connectionWork) {
            $this->setState(State::DOWN);
        }
    }
}
