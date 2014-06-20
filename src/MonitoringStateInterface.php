<?php

namespace CanalTP\SamMonitoringComponent;

class MonitoringStateInterface
{
    const UP          = 1;
    const UNKNOWN     = 0;
    const DOWN        = -1;
    const WARNING     = -2;
}
