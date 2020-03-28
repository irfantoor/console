<?php

use IrfanTOOR\Console;
use IrfanTOOR\Test;

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
        $c = new Console();
        $supported = stream_isatty(STDOUT);

        foreach ($c->getStyles() as $k => $v) {
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

    function testgetStyles()
    {
        $c = new Console();
        $styles = $c->getStyles();
        $this->assertArray($styles);

        foreach ($styles as $name => $def) {
            $this->assertString($name);
            if ($name === 'none') {
                $this->assertNull($def);
            } else {
                $this->assertString($def);
            }

            $this->assertEquals((int) $def, $def);
        }
    }

    function testGetTheme()
    {
        $c = new Console();
        $theme = $c->getTheme();
        $this->assertArray($theme);

        foreach ($theme as $style => $def) {
            $this->assertArray($def);
        }

        $this->assertTrue(isset($theme['info']));
        $this->assertTrue(isset($theme['error']));
        $this->assertTrue(isset($theme['warning']));
        $this->assertTrue(isset($theme['success']));
    }
}
