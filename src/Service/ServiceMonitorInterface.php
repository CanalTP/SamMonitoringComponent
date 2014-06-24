<?php

namespace CanalTP\SamMonitoringComponent\Service;

use CanalTP\SamMonitoringComponent\StateMonitorInterface as State;

interface ServiceMonitorInterface
{
    public function getName();
    public function setName($name);

    public function getState();
    public function setState(State $state);

    public function getMessage();
    public function setMessage($message);

    public function check();
}
