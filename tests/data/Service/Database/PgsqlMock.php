<?php

namespace CanalTP\SamMonitoringComponent\Test\Data\Service\Database;

use CanalTP\SamMonitoringComponent\StateMonitorInterface as State;
use CanalTP\SamMonitoringComponent\Service\AbstractServiceMonitor;

class PgsqlMock extends \CanalTP\SamMonitoringComponent\Service\Database\Pgsql
{
    private $connectionWork = false;
    
    public function __construct($connection)
    {
        parent::__construct('host', 'port', 'name', 'user', 'password');
        
        $this->connectionWork = $connection;
    }
    
    protected function checkConnection()
    {
        if (!$this->connectionWork) {
            $this->setState(State::DOWN);
        }
    }
}
