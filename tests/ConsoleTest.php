<?php
 
use IrfanTOOR\Console;
use IrfanTOOR\Test;

class MockConsole extends Console
{
    static function getStyles()
    {
        return self::$styles;
    }
}

class ConsoleTest extends Test 
{
    protected $console;

    function setup()
    {
        $this->console = new Console;
    }

    function testConsoleClassExists()
    {
        $this->assertInstanceOf(Console::class, $this->console);
    }

    function testConsoleCanRead()
    {
        $this->assertTrue(method_exists($this->console, 'read'));
        ob_start();
        $input = $this->console->read("Hello World!");
        $output = ob_get_clean();
        $this->assertEquals("Hello World!", $output);
        $this->assertEquals("", $input);
    }

    function testConsoleCanWrite()
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

    function testConsoleCanWriteWithStyle()
    {
        $c = new MockConsole();
        $supported = stream_isatty(STDOUT);

        foreach ($c::getStyles() as $k => $v) {
            $txt = 'Hello World!';

            if ($v && $supported) {
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
