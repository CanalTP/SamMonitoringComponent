<?php

namespace CanalTP\SamMonitoringComponent;

interface MonitorableServiceInterface
{
    public function getName();
    public function getState();
}
