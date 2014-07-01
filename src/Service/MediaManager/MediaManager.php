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
        if ($this->getState() != State::DOWN && !is_readable($this->path)) {
            $this->setState(State::DOWN);
            $this->setMessage('Folder can\'t be readable. (' . $this->path . ')');
        }
    }

    private function checkIsWridable()
    {
        if ($this->getState() != State::DOWN && !is_writable($this->path)) {
            $this->setState(State::DOWN);
            $this->setMessage('Folder can\'t be readable. (' . $this->path . ')');
        }
    }

    private function checkFileExist()
    {
        if ($this->getState() != State::DOWN && !file_exists($this->path)) {
            $this->setState(State::DOWN);
            $this->setMessage('Folder does not exist. (' . $this->path . ')');
        }
    }

    public function check()
    {
        $this->checkFileExist();
        $this->checkIsReadable();
        $this->checkIsWridable();
        $this->setState(($this->getState() == State::UNKNOWN) ? State::UP : $this->getState());
    }
}
