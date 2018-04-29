<?php

namespace IrfanTOOR\Console;

use IrfanTOOR\Console;

class Command
{
    protected $commands;
    protected $args;
    protected $console;
    protected $help;

    public function __construct()
    {
        $this->console = new Console;

        if (!$_SERVER['argc'])
            throw new \Exception("Must run in console mode only", 1);

        $this->args = $_SERVER['argv'];
        if (!is_array($this->help)) {
            $this->help = [];
        }
        
        if (isset($this->help['help'])) {
            $help_help = $this->help['help'];
            unset($this->help['help']);
        } else {
            $help_help =  [
                'help' => [
                    'Display help of commands',
                    '
Displays help of commands

FORMAT
------
help [command]

OPTIONS
-------
command    command for which help is required
'           
                ]
            ];
        }
        
        $title = [];
        
        foreach($this->help as $k=>$v) {
            $title = [$k => $v];
            array_shift($this->help);
            break;
        }

        ksort($this->help);    
        $this->help = array_merge($title, $this->help, $help_help);    
    }

    public function _dump($v, $trace = true, $level = 0) {
        $spaces = substr('                                                   ',
                        0,
                        4 * $level);

        if (is_array($v)) {
            foreach ($v as $key => $value) {
                $this->write($spaces . $key . ': ', 'yellow');
                if (is_array($value)) {
                    echo PHP_EOL;
                    $this->dump($value, false, $level + 1);
                } else {
                    if (is_string($value)) {
                        $value = '"' . $value . '"';
                    } elseif (is_bool($value)) {
                        $value = $value ? 'true' : 'false';
                    }
                    $this->writeln($value);
                }
            }
        } else {
            Debug::dump($v, $trace);
        }
    }
    
    private function _method($command)
    {
        if (!is_string($command)) {
            return null;
        }
        
        $method = str_replace(':', '_', $command);
        if (strpos($method, '_') === 0)
            return null;
        
        if ($method === 'run' || !method_exists($this, $method))
        {
            return null;
        }   
            
        return $method;
    }

    public function help($args=null)
    {
        $help     = $this->help;
        $command  = $args ? $args[0] : null;
        $method  = $this->_method($command);
        
        $title = null;
        
        # max string length of a command
        # and if the
        $max   = -1;
        foreach($help as $cmd => $hlp) {
            if ($max === -1) {
                $max = 0;
                continue;
            }

            $max = max($max, strlen($cmd));
        }

        # iterate through the help
        foreach($help as $cmd => $hlp) {
            # process first element as title
            if (!$title) {
                if ($method) {
                    $title = $command;
                } else {
                    if (is_string($cmd)) {
                        $title = $cmd . ' -- ' . $hlp;
                    } else {
                        $title = $hlp;
                    }
                }
                
                # title
                $this->writeln('');
                $this->writeln([$title], ['bg_blue']);

                if (!$method) {
                    # commands section
                    $this->writeln('COMMANDS');
                    $this->writeln('--------');
                }
                
                continue;
            }
            
            # if help is required for a specific command, skip others
            if ($method && ($cmd !== $command))
                 continue;
            
            if (is_string($hlp) && strpos($hlp, 'class:') === 0) {
                # external class
                $this->writeln($cmd . ' -- ' . 'to be retreived from the class');
            } else {
                # space between every command and its short description
                $spaces = substr(
                    '                                                         ',
                    0,
                    $max + 4 - strlen($cmd)
                );

                if (is_array($hlp))
                    $hlp = $method ? $hlp[1] : $hlp[0];

                if (!$method) {
                    $this->write($cmd . $spaces);
                }

                $this->writeln($hlp, 'yellow');            
            }
        }
    }

    public function run()
    {
        $args = $this->args;
        array_shift($args);
        $command = array_shift($args);
        $help     = $this->help;
        $method  = $this->_method($command);
        
        if ($method) {
            $this->$method($args);
        } else {
            $this->help();
        }
    }

    public function write($txt, $style = 'green')
    {
        $this->console->write($txt, $style);
    }

    public function writeln($txt, $style = 'green')
    {
        $this->console->writeln($txt, $style);
    }
}
