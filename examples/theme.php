<?php

require dirname(__DIR__) . "/vendor/autoload.php";

$c = new IrfanTOOR\Console([
    'info' => ['bg_black', 'yellow'],
    'url'  => ['red', 'underline'],
]);

# Theme
$c->writeln("Modified theme >> info", "info");
$c->writeln("https://github.com/irfantoor/console", "url");
