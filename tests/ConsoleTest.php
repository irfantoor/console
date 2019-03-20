<?php
 
use IrfanTOOR\Console;
use IrfanTOOR\Test;

class ConsoleTest extends Test 
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

        foreach ($c::$styles as $k => $v) {
            $txt = 'Hello World!';

            if ($v) {
                $expected = "\033[{$v}m" . $txt . "\033[0m";
            } else {
                $expected = $txt;
            }

            ob_start();
                $c->write($txt, $k);
            $output = ob_get_clean();
            
            $this->assertEquals($expected, $output);
        }
    }
}
