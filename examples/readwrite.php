<?php

require dirname(__DIR__) . "/vendor/autoload.php";

use IrfanTOOR\Console;

$c = new Console;

$c->writeln(['Its a banner'], ['bg_blue','white']);
$c->write("Hello ", "green");
$c->writeln("World ", "red");

$response = $c->read("Are you ok? [Y/N]", "cyan");

$c->write("you responded with: ");
$c->writeln($response, ["bg_white","black"]);
