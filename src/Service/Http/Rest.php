<?php

namespace CanalTP\SamMonitoringComponent\Service\Http;

use CanalTP\SamMonitoringComponent\StateMonitorInterface as State;
use CanalTP\SamMonitoringComponent\Service\AbstractServiceMonitor;

class Rest extends AbstractServiceMonitor
{
    private $host;
    private $code;
    private $verb;

    public function __construct($host, $serviceName, $code = 200, $verb = 'GET')
    {
        parent::__construct();

        $this->name = ucfirst($serviceName);
        $this->state = State::UNKNOWN;

        $this->host = $host;
        $this->verb = $verb;
        $this->code = $code;
    }

    public function check()
    {
        $curl = curl_init($this->host);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $this->verb);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_exec($curl);
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($code == $this->code) {
            $this->state = State::UP;
        } else {
            $this->state = State::DOWN;
            $this->message = 'Service (' . $this->host . ') response code ' . $code . ' not ' . $this->code;
        }

    }

}
