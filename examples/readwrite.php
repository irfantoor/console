<?php

require dirname(__DIR__) . "/vendor/autoload.php";

use IrfanTOOR\Console;

$c = new Console;

$response = $c->read("Are you ok? [Y/N]", "info");

$c->write("you responded with: ");
$c->writeln($response, ["info", "reverse"]);
