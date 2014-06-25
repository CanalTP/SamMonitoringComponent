<?php

namespace CanalTP\SamMonitoringComponent\Service\MediaManager;

use CanalTP\SamMonitoringComponent\StateMonitorInterface as State;
use CanalTP\SamMonitoringComponent\Service\AbstractServiceMonitor;

class MediaManager extends AbstractServiceMonitor
{
    private $path = null;

    public function __construct($path)
    {
        parent::__construct();

        $this->setName('MediaManager');
        $this->state = State::UNKNOWN;
        $this->path = $path;
    }

    private function checkIsReadable()
    {
        if ($this->state != State::DOWN && !is_readable($this->path)) {
            $this->state = State::DOWN;
            $this->setMessage('Folder can\'t be readable. (' . $this->path . ')');
        }
    }

    private function checkIsWridable()
    {
        if ($this->state != State::DOWN && !is_writable($this->path)) {
            $this->state = State::DOWN;
            $this->setMessage('Folder can\'t be readable. (' . $this->path . ')');
        }
    }

    private function checkFileExist()
    {
        if ($this->state != State::DOWN && !file_exists($this->path)) {
            $this->state = State::DOWN;
            $this->setMessage('Folder does not exist. (' . $this->path . ')');
        }
    }

    public function check()
    {
        $this->checkFileExist();
        $this->checkIsReadable();
        $this->checkIsWridable();
        $this->state = ($this->state == State::UNKNOWN) ? State::UP: $this->state;
    }
}
