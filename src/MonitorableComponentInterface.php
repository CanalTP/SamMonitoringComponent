<?php

namespace CanalTP\SamMonitoringComponent;

interface MonitorableComponentInterface
{
    public function getName();
    public function getState();
    public function getMonitorableCategories();
}
