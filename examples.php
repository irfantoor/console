<?php

require "vendor/autoload.php";

$c = new IrfanTOOR\Console;
$c->writeln("Hello World!");

# Theme
$c->writeln("Info: Hello World!", "info");
$c->writeln("Warning: Hello World!", "warning");
$c->writeln("Success: Hello World!", "success");
$c->writeln("Error: Hello World!", "error");

# Using Foreground and Background
$c->writeln("White on Red: Hello World!", ["bgRed", "white"]);
$c->writeln("White on Blue: Hello World!", ["bgBlue", "white"]);

# Banner
$c->writeln(["White on Red Banner: Hello World!"], ["bgRed", "white"]);
$c->writeln(
	[
		"White on Blue Banner: Hello World!",
		"With multiple lines",
		"    and smiles! :-)",
	], 
	["bgBlue", "white"]
);

$name = $c->read("Your name: ", "red");
$c->writeln(["Hello " . $name], ["bgBlack", "white"]);
