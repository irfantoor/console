<?php
 
use IrfanTOOR\Console;

use PHPUnit\Framework\TestCase;
use IrfanTOOR\Console\ShellCommand;

class ShellCommandTest extends TestCase 
{
    protected $cmd;
    
    function setup()
    {
        $this->cmd = new ShellCommand;
    }
    
    public function testInstanceOfConsoleShellCommand(): void
	{
	    $this->assertInstanceOf('IrfanTOOR\Console\ShellCommand', $this->cmd);
	}
	
	public function testShellCommandExecute(): void
	{
	    $this->assertFalse($this->cmd->execute('itsNotAValidCommmad'));
	    $this->assertTrue($this->cmd->execute('date'));
	}

	public function testShellCommandExitCode(): void
	{
	    $this->cmd->execute('itsNotAValidCommmad');
	    $this->assertEquals(127, $this->cmd->exitCode());
	    
	    $this->cmd->execute('date');
	    $this->assertEquals(0, $this->cmd->exitCode());
	}
	
	public function testShellCommandOutput(): void
	{
	    ob_start();
	    System('date');
	    $result = ob_get_clean();
        $this->cmd->execute('date');
	    $this->assertEquals($result, $this->cmd->output());
	}	
}
    
