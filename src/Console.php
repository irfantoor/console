<?php

namespace IrfanTOOR;

/**
 * A simple console
 */
class Console
{
    /**
     * @var const
     */
    const NAME = "Irfan's Console";

    /**
     * @var const
     */
    const DESCRIPTION = "A bare minimum console with colors";

    /**
     * @var const
     */
    const VERSION = "0.6.2"; // @@VERSION

    /**
     * @var bool
     */
    protected $is_terminal = false;

    /**
     * @var bool
     */
    protected $supported = false;

    /**
     * List of console styels
     *
     * @var array
     */
    protected $styles = array(
        'none' => null,
        'bold' => '1',
        'dark' => '2',
        'italic' => '3',
        'underline' => '4',
        'blink' => '5',
        'reverse' => '7',
        'concealed' => '8',

        'default' => '39',
        'black' => '30',
        'red' => '31',
        'green' => '32',
        'yellow' => '33',
        'blue' => '34',
        'magenta' => '35',
        'cyan' => '36',
        'light_gray' => '37',

        'dark_gray' => '90',
        'light_red' => '91',
        'light_green' => '92',
        'light_yellow' => '93',
        'light_blue' => '94',
        'light_magenta' => '95',
        'light_cyan' => '96',
        'white' => '97',

        'bg_default' => '49',
        'bg_black' => '40',
        'bg_red' => '41',
        'bg_green' => '42',
        'bg_yellow' => '43',
        'bg_blue' => '44',
        'bg_magenta' => '45',
        'bg_cyan' => '46',
        'bg_light_gray' => '47',

        'bg_dark_gray' => '100',
        'bg_light_red' => '101',
        'bg_light_green' => '102',
        'bg_light_yellow' => '103',
        'bg_light_blue' => '104',
        'bg_light_magenta' => '105',
        'bg_light_cyan' => '106',
        'bg_white' => '107',
    );

    /**
     * Default Theme
     *
     * @var array
     */
    protected $theme = [
        'info'     => ['cyan'],
        'error'    => ['bg_red', 'bold'],
        'warning'  => ['bg_light_yellow', 'red', 'bold'],
        'success'  => ['bg_green', 'bold'],

        'note'     => ['bg_light_yellow', 'black'],
        'footnote' => ['dark'],
        'url'      => ['blue', 'underline'],
    ];

    /**
     * Constructs a console
     *
     * @param array
     */
    function __construct(array $theme = [])
    {
        $this->is_terminal = PHP_SAPI === 'cli';
        $this->supported = stream_isatty(STDOUT);
        $this->setTheme($theme);
    }

    /**
     * Returns array of defined styles
     *
     * @return array
     */
    public function getStyles()
    {
        return $this->styles;
    }

    /**
     * Returns array of defined styles of a theme
     *
     * @return array
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Sets styles of a theme
     *
     * @param array e.g. ['style' => ['bg_red', 'bold'], ...]
     */
    public function setTheme(array $theme)
    {
        $this->theme = array_merge(
            $this->theme,
            $theme
        );
    }

    /**
     * Returns the text with the styles applied to it
     *
     * @param string
     * @param string|array
     *
     * @return string
     */
    function applyStyle($text, $styles = []): string
    {
        if (!$styles)
        {
            $styles = "none";
        }

        if (!$this->is_terminal || !$this->supported)
            return $text;

        if (is_string($styles))
        {
            $styles = [$styles];
        }

        $output = $text;

        foreach ($styles as $style) {
            if (isset($this->theme[$style])) {
                $output = $this->applyStyle($output, $this->theme[$style]);
            } else {
                if (isset($this->styles[$style])) {
                    $pre  = $this->_escSequence($this->styles[$style]);
                    $post = $this->_escSequence(0);
                } else {
                    $pre = $post = '';
                }

                $output = $pre . $output . $post;
            }
        }

        return $output;
    }

    /**
     * Returns escape sequence to change color
     *
     * @param string $value
     * @return string
     */
    private function _escSequence(string $value): string
    {
        return "\033[{$value}m";
    }

    /**
     * Read a line from input with an optional prompt and optional style
     *
     * @param string $prompt can be string to be prompted before reading from console
     * @param null|string|array $style can be null, a style code as string or an array of strings.
     *
     * @return the line read from console
     */
    function read(string $prompt, $style = null): string
    {
        $this->write($prompt, $style);

        if (!$this->is_terminal) return "";

        $stdin = fopen('php://stdin', 'r');
        $str = fgets($stdin, 4096);
        fclose($stdin);
        return preg_replace('{\r?\n$}D', '', $str);
    }

    /**
     * Write a line or a group of lines to output
     *
     * @param string|array $text can be string or an array of strings
     * @param null|string|array $style can be null, a style code as string or an array of strings.
     */
    function write($text = '', $style = null): void
    {
        if (is_array($text)) {
            $max = 0;

            foreach($text as $txt) {
                $max = max($max, strlen($txt));
            }

            $outline = str_repeat(' ', $max + 4);
            $this->writeln($outline, $style);

            foreach($text as $txt) {
                $len = strlen($txt);
                $pre_space  = str_repeat(' ', 2);
                $post_space = str_repeat(' ', $max + 2 - $len);
                $this->writeln($pre_space . $txt . $post_space, $style);
            }

            $this->writeln($outline, $style);
        }
        else {
            echo $this->applyStyle($text, $style);
        }
    }

    /**
     * Write a line or a group of lines to output and an End of Line finally.
     *
     * @param string|array $text can be string or an array of strings
     * @param null|string|array $style can be null, a style code as string or an array of strings.
     */
    function writeln($text = '', $style = null): void
    {
        echo $this->write($text, $style);
        echo PHP_EOL;
    }
}
