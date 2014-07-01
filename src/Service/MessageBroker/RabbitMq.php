<?php

namespace CanalTP\SamMonitoringComponent\Service\MessageBroker;

use CanalTP\SamMonitoringComponent\StateMonitorInterface as State;
use CanalTP\SamMonitoringComponent\Service\AbstractServiceMonitor;
use PhpAmqpLib\Connection\AMQPConnection;

class RabbitMq extends AbstractServiceMonitor
{
    private $host = null;
    private $port = null;
    private $vhost = null;
    private $login = null;
    private $password = null;
    private $amqpConnection = null;

    public function __construct($host, $port, $vhost, $login, $password)
    {
        parent::__construct();

        $this->setName('RabbitMQ');
        $this->setState(State::UNKNOWN);
        $this->host = $host;
        $this->port = $port;
        $this->vhost = $vhost;
        $this->login = $login;
        $this->password = $password;
    }

    private function checkConnection()
    {
        try {
            $this->amqpConnection = new AMQPConnection(
                $this->host,
                $this->port,
                $this->login,
                $this->password,
                $this->vhost
            );
        } catch (\Exception $ex) {
            $this->setState(State::DOWN);
            $this->setMessage('RabbitMQ Server not responding (' . $ex->getMessage() . ')');
        }
        if ($this->amqpConnection) {
            $this->amqpConnection->close();
        }
    }

    public function check()
    {
        $this->checkConnection();
        $this->setState(($this->getState() == State::UNKNOWN) ? State::UP : $this->getState());
    }
}
