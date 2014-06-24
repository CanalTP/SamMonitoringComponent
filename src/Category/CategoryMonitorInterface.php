<?php

namespace CanalTP\SamMonitoringComponent\Category;

use CanalTP\SamMonitoringComponent\Service\ServiceMonitorInterface;

interface CategoryMonitorInterface
{
    public function getName();
    public function setName($name);

    public function addService(ServiceMonitorInterface $service);
    public function getServices();

    public function check();
}
