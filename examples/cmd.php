<?php

require dirname(__DIR__) . "/vendor/autoload.php";

use IrfanTOOR\Console\Command;
use IrfanTOOR\Console\ShellCommand;

class TestCommand extends Command
{
    function __construct()
    {
        $this->help = [
            # the first line is the title of this command
            'cmd' => 'Test Command',
            
            # help of the sub commands
            'cmd:format' => [
                'Short description',
                '
Long Description

FORMAT
------
test:format [args]

OPTIONS
-------
args    optional arguments
'
            ],
            'cmd:hello' => [
                'Says hello world!',
                'Says Hello World! What a pleasent day',
            ],
            'cmd:date' => 'Displays the current date',
            'cmd:cal' => 'Displays the calendar of current month',
            'cmd:dump' => 'Dumps the help array',
        ];
        
        parent::__construct();
    }
    
    function cmd_hello($args) {
        $this->writeln("Hello World!");
        $this->_dump($args);
    }
    
    function cmd_format($args)
    {
        $this->writeln("format format format ...");
    }
    
    function cmd_date()
    {
        $cmd = new ShellCommand();
        $cmd->execute('date');
        $this->writeln($cmd->output());
    }

    function cmd_cal()
    {
        $cmd = new ShellCommand();
        $cmd->execute('cal');
        $this->writeln($cmd->output());
    }
    
    function cmd_dump()
    {
        $this->_dump($this->help);
    }
}

$c = new TestCommand;
$c->run();
