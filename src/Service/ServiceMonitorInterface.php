<?php

namespace CanalTP\SamMonitoringComponent\Service;

interface ServiceMonitorInterface
{
    public function getName();
    public function setName($name);

    public function getState();
    public function setState($state);

    public function getMessage();
    public function setMessage($message);

    public function check();
}
