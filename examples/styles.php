<?php

require dirname(__DIR__) . "/vendor/autoload.php";

$c = new IrfanTOOR\Console;

$c1 = 20;
$c2 = 50;

$line = str_repeat('-', $c1+$c2+6);

$c->writeln("Foreground Styles", 'bold');
$c->writeln($line);

foreach ($c->getStyles() as $k => $v) {
    if (strpos($k, 'bg_') !== false)
            continue;

    $txt = "Its written with style -- $k";
    $l  = strlen(" $k ");
    $l2 = strlen($txt);

    $c->write("| $k " . str_repeat(' ', $c1 - $l) . '| ');
    $c->write("$txt " . str_repeat(' ', $c2 - $l2), $k);
    $c->writeln(" |");
}

$c->writeln($line);

$c->writeln("Background Styles", 'bold');
$c->writeln($line);

foreach ($c->getStyles() as $k => $v) {
    if (strpos($k, 'bg_') === false)
            continue;

    $txt = "Its written with style -- $k";
    $l  = strlen(" $k ");
    $l2 = strlen($txt);

    $c->write("| $k " . str_repeat(' ', $c1 - $l) . '| ');
    $c->write("$txt " . str_repeat(' ', $c2 - $l2), $k);
    $c->writeln(" |");
}

$c->writeln($line);

$c->writeln("Theme Styles", 'bold');
$c->writeln($line);

foreach ($c->getTheme() as $k => $v) {
    if (strpos($k, 'bg_') !== false)
            continue;

    $txt = "Its written with style -- $k";
    $l  = strlen(" $k ");
    $l2 = strlen($txt);

    $c->write("| $k " . str_repeat(' ', $c1 - $l) . '| ');
    $c->write("$txt " . str_repeat(' ', $c2 - $l2), $k);
    $c->writeln(" |");
}

$c->writeln($line);
