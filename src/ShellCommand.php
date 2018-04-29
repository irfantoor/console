<?php

namespace IrfanTOOR\Console;

class ShellCommand
{
    protected $output;
    protected $exit_code;

    function __construct()
    {
        $this->output = '';
        $this->exit_code = 0;
    }

    function exitCode()
    {
        return $this->exit_code;
    }

    function output()
    {
        return $this->output;
    }

    function execute($command)
    {
        $command .= ' 2>&1';
        ob_start();
        system($command, $this->exit_code);
        $this->output = ob_get_clean();
        return ($this->exit_code === 0);
    }
}
