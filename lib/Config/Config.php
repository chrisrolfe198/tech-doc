<?php

namespace ThatChrisR\TechDocs\Config;

class Config
{
    protected $config;

    public function get($name)
    {
        if (!$this->config) $this->config = require('../app/config.php');
        if (isset($this->config[$name])) return $this->config[$name];
        throw new \InvalidArgumentException("Configuration option doesn't exist");
    }
}
