<?php
 
use IrfanTOOR\Console;

use PHPUnit\Framework\TestCase;
use IrfanTOOR\Console\Command;

class TestCommand extends Command
{
    function __construct()
    {    
        $this->help = [
            'cmd' => 'its a test command',
            'cmd:info' => [
                'info short help',
                'info long help',
            ],
        ];
        
        parent::__construct();
    }
    
    function cmd_info($args)
    {
        return $args;
    }
    
    function getHelp() {
        return $this->help;
    }
    
    function cmd_dump($v)
    {
        $this->_dump($v);
    }
}


class CommandTest extends TestCase 
{
    public function testInstanceOfConsoleCommand(): void
	{
	    $c = new TestCommand();
	    $this->assertInstanceOf('IrfanTOOR\Console\Command', $c);
	}
	
    public function testCommandHelp(): void
	{
	    $cmd = new TestCommand();
	    $help = $cmd->getHelp();
	    ob_start();
	    $cmd->help();
	    $help_output = ob_get_clean();
	    
	    $this->assertNotFalse(strpos($help_output, $help['cmd']));
	    $this->assertTrue(strpos($help_output, $help['cmd:info'][0])>0);
	}

    public function testCommandDetailedHelp(): void
	{
	    $cmd = new TestCommand();
	    $help = $cmd->getHelp();
	    ob_start();
	    $cmd->help(['cmd:info']);
	    $help_output = ob_get_clean();
	    
	    $this->assertFalse(strpos($help_output, $help['cmd']));
	    $this->assertTrue(strpos($help_output, $help['cmd:info'][1])>0);
	}
	
    public function testCommandRun(): void
	{
	    $cmd = new TestCommand();
	    ob_start();
	    $cmd->help();
	    $help_output = ob_get_clean();
	    
	    ob_start();
	    $cmd->run();
	    $run_output = ob_get_clean();
	    
	    $this->assertEquals($help_output, $run_output);
	}	
	
    public function testCommandExecution(): void
	{
	    $cmd = new TestCommand();
	    $args = $cmd->cmd_info(null);
	    $args2 = $cmd->cmd_info(['hello', 'world']);
	    
	    $this->assertNull($args);
	    $this->assertEquals(['hello', 'world'], $args2);
	}
	
	public function testCommandDump(): void
	{
	    $cmd = new TestCommand();
	    
	    ob_start();
	    $cmd->cmd_dump('Hello World!');
	    $output = ob_get_clean();
	    
	    ob_start();
	    $cmd->writeln('Hello World!', 'light_cyan');
	    $output2 = ob_get_clean();
	    
	    $this->assertEquals($output, $output2);

	    ob_start();
	    $cmd->cmd_dump(
	        [
	            'a' => 1, 
	            'b' => [
	                'c' => 3
	            ],
	        ]
	    );
	    $output = ob_get_clean();
        
        ob_start();
        $cmd->write('a: ', 'yellow');
        $cmd->writeln('1', 'green');
        $cmd->writeln('b: ', 'yellow');
        $cmd->write('    c: ', 'yellow');
        $cmd->writeln('3', 'green');
        $output2 = ob_get_clean();
        
	    $this->assertEquals($output, $output2);
	    
	}
}
    
