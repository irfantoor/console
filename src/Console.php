<?php 

namespace IrfanTOOR;

use JakubOnderka\PhpConsoleColor\ConsoleColor;

/**
 * A simple console
 */
class Console
{
	protected $cc;

	/**
	 * Constructs a console
	 */
	public function __construct() {
		$this->cc = new ConsoleColor();
		$this->cc->addTheme('info', ['light_cyan']);
		$this->cc->addTheme('warning', ['bg_light_yellow', 'black']);
		$this->cc->addTheme('error', ['bg_light_red', 'white']);
		$this->cc->addTheme('success', ['bg_green', 'white']);
	}

	/**
	 * Read a line from input with an optional prompt and optional style
	 * 
	 * @param string $prompt can be string to be prompted before reading from console
	 * @param mixed $style can be null, a style code as string or an array of strings.
	 *
	 * @return the line read from console
	 */
	function read($prompt, $style='') {
		$this->write($prompt, $style);
		$line = readline();

		return $line;
	}

	/**
	 * Write a line or a group of lines to output
	 * 
	 * @param mixed $text can be string or an array of strings
	 * @param mixed $style can be null, a style code as string or an array of strings.
	 */	
	function write($text='', $style='none') {
		if (is_array($text)) {
			$max = 0;
			foreach($text as $txt) {
				$max = max($max, strlen($txt));
			}
			$outline = str_repeat(' ', $max + 4);
			$this->writeln($outline, $style);
			foreach($text as $txt) {
				$len = strlen($txt);
				$pre_space = str_repeat(' ', 2);
				$post_space = str_repeat(' ', $max+2 - $len);
				$this->writeln($pre_space . $txt . $post_space, $style);
			}
			$this->writeln($outline, $style);
		} 
		else {
			echo $this->cc->apply($style, $text);
		}
	}

	/**
	 * Write a line or a group of lines to output and an End of Line finally.
	 * 
	 * @param mixed $text can be string or an array of strings
	 * @param mixed $style can be null, a style code as string or an array of strings.
	 */	
	function writeln($text='', $style='none') {
		echo $this->write($text, $style);
		echo PHP_EOL;
	}	
}
