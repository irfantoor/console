<?php

require dirname(__DIR__) . "/vendor/autoload.php";

$c = new IrfanTOOR\Console();

# Theme
$c->writeln("theme -> info: This is written with style 'info'", "info");
$c->writeln("theme -> url: https://github.com/irfantoor/console", "url");

$c->writeln();
$c->writeln("Modifying theme ...", "warning");
$c->writeln();

$c->setTheme([
    'info' => ['bg_black', 'yellow'],
    'url'  => ['red', 'underline'],
]);

$c->writeln("theme -> info: This is written with style 'info'", "info");
$c->writeln("theme -> url: https://github.com/irfantoor/console", "url");

$c->setTheme([
    'url' => ['bg_blue', 'white']
]);

$c->writeln("https://github.com/irfantoor/console", "url");
