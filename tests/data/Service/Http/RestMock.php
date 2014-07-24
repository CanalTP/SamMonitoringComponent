<?php

namespace CanalTP\SamMonitoringComponent\Test\Data\Service\Http;

use CanalTP\SamMonitoringComponent\StateMonitorInterface as State;
use CanalTP\SamMonitoringComponent\Service\AbstractServiceMonitor;

class RestMock extends \CanalTP\SamMonitoringComponent\Service\Http\Rest
{
    public function __construct($host, $code)
    {
        parent::__construct($host, 'test', $code);
    }

    public function check()
    {
        parent::check();
    }
}
