<?php

require dirname(__DIR__) . "/vendor/autoload.php";

$c = new IrfanTOOR\Console;

# Banner
# when the text to write is passed as an array of lines, it is displayed as banner
$c->writeln(["White on Red Banner: Hello World!"], ["bg_red", "white"]);
$c->writeln(
    [
        "Its a banner",
        "styles: ['bg_light_yellow', 'black']",
        "With multiple lines",
        "    and smiles! :-)",
    ],
    [
        "bg_light_yellow", "black"
    ]
);
