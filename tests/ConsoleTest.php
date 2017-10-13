<?php
 
use IrfanTOOR\Console;

use PHPUnit\Framework\TestCase;

class ConsoleTest extends TestCase 
{

	protected $console;

	public function setup(): void
	{
		$this->console = new Console;
	}

	public function testConsoleClassExists(): void
	{
	    $this->assertInstanceOf('IrfanTOOR\Console', $this->console);
	}

	public function testConsoleWrite(): void
	{
		$c = $this->console;

	    ob_start();
	    $c->write('Hello World!');
	    $output = ob_get_clean();
	    
	    $this->assertEquals('Hello World!', $output);

	    ob_start();
	    $c->writeln('Hello World!');
	    $output = ob_get_clean();

	    $this->assertEquals('Hello World!' . PHP_EOL, $output);
	}

	public function testConsoleWriteWithStyle(): void
	{
	    $c = $this->console;

	    ob_start();
	    	$c->write('Hello World!', 'color_25');
	    $output = ob_get_clean();
		
        $this->assertEquals("\033[38;5;25mHello World!\033[0m", $output);
	}
}
