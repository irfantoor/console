<?php

require dirname(__DIR__) . "/vendor/autoload.php";

$c = new IrfanTOOR\Console;
$c->writeln("Hello World!");


# Theme
$c->writeln("Info: Hello World!", "info");
$c->writeln("Warning: Hello World!", "warning");
$c->writeln("Error: Hello World!", "error");
$c->writeln("Success: Hello World!", "success");

# Using Foreground and Background
$c->writeln("> color_130 on bg_color_135: Hello World!", ["bg_color_235", "color_130"]);
$c->writeln("white on bg_light_blue: Hello World!", ["bg_blue", "white"]);
$c->writeln("cyan on bg_white: Hello World!", ["cyan", "bg_white"]);

# Banner
# when the text to write is passed as an array of lines, it is displayed as banner
$c->writeln(["White on Red Banner: Hello World!"], ["bg_red", "white"]);
$c->writeln(
	[
		"White on Blue Banner: Hello World!",
		"With multiple lines",
		"    and smiles! :-)",
	], 
	["bg_blue", "white"]
);

# $name = $c->read("Your name: ", "cyan");
# $c->writeln(["Hello " . $name], ["bg_light_yellow", "blue"]);

echo "\n";

echo "Foreground colors:\n";
for ($i = 0; $i <= 255; $i++) {
	echo $c->write(str_pad($i, 6, ' ', STR_PAD_BOTH), ["color_$i"]);

	if ($i % 16 === 15) {
		echo "\n";
	}
}

echo "\nBackground colors:\n";

for ($i = 0; $i <= 255; $i++) {
	echo $c->write(str_pad($i, 6, ' ', STR_PAD_BOTH), ["bg_color_$i", "black"]);

	if ($i % 16 === 15) {
		echo "\n";
	}
}
