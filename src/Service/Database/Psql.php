<?php

namespace CanalTP\SamMonitoringComponent\Service\Database;

use CanalTP\SamMonitoringComponent\StateMonitorInterface as State;
use CanalTP\SamMonitoringComponent\Service\AbstractServiceMonitor;

class Psql extends AbstractServiceMonitor
{
    private $connection = null;

    public function __construct($host, $port, $name, $user, $password)
    {
        parent::__construct();

        $this->setName('PostgreSQL');
        $this->state = State::UP;
        $this->connection = "host=$host port=$port dbname=$name user=$user password=$password";
    }

    private function checkConnection()
    {
        // TODO: Remove the '@' and use try / catch
        $db = @pg_connect($this->connection);

        if ($this->state == State::UP && !pg_ping($db)) {
            $this->state = State::DOWN;
            $this->setMessage("Can't connect to database.");
        }

        if ($db) {
            pg_close($db);
        }
    }

    public function check()
    {
        $this->checkConnection();
    }
}
