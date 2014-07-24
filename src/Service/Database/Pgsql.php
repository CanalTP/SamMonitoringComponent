<?php

namespace CanalTP\SamMonitoringComponent\Service\Database;

use CanalTP\SamMonitoringComponent\StateMonitorInterface as State;
use CanalTP\SamMonitoringComponent\Service\AbstractServiceMonitor;

class Pgsql extends AbstractServiceMonitor
{
    private $connection = null;

    public function __construct($host, $port, $name, $user, $password)
    {
        parent::__construct();

        $this->setName('PostgreSQL');
        $this->setState(State::UNKNOWN);
        $this->connection = "host=$host port=$port dbname=$name user=$user password=$password";
    }

    private function checkConnection()
    {
        // TODO: Remove the '@' and use try / catch
        $db = @pg_connect($this->connection);

        if ($this->state != State::DOWN && !pg_ping($db)) {
            $this->setState(State::DOWN);
            $this->setMessage("Can't connect to database.");
        }

        if ($db) {
            pg_close($db);
        }
    }

    public function check()
    {
        $this->checkConnection();
        $this->setState(($this->getState() == State::UNKNOWN) ? State::UP : $this->getState());
    }
}
