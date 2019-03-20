# IrfanTOOR\Console

A bare minimum console with colors.

## Usage

See different examples in the examples folder.

```php
<?php

require dirname(__DIR__) . "/vendor/autoload.php";

use IrfanTOOR\Console;

$c = new Console;

# printing with style
$c->write("Hello ", "green");
$c->writeln("World ", "red");

# when a string of texts is given, a banner is printed
$c->writeln(['Its a banner'], ['bg_blue','white']);

# reading from console
$response = $c->read("Are you ok? [Y/N]", "info");

$c->write("you responded with: ");
$c->writeln($response, ["info", "reverse"]);
```

## Styles

### Foreground Styles
 - none
 - bold
 - dark
 - italic
 - underline
 - blink
 - reverse
 - concealed
 - default
 - black
 - red
 - green
 - yellow
 - blue
 - magenta
 - cyan
 - light_gray
 - dark_gray
 - light_red
 - light_green
 - light_yellow
 - light_blue
 - light_magenta
 - light_cyan
 - white

### Background Styles
 - bg_default
 - bg_black
 - bg_red
 - bg_green
 - bg_yellow
 - bg_blue
 - bg_magenta
 - bg_cyan
 - bg_light_gray
 - bg_dark_gray
 - bg_light_red
 - bg_light_green
 - bg_light_yellow
 - bg_light_blue
 - bg_light_magenta
 - bg_light_cyan
 - bg_white

### Theme Styles
 - info
 - error
 - warning
 - success
 - note
 - footnote
 - url

Note: All the theme styles can be modiied by providing the definition while creating the console.

```php
<?php
 
$c = new IrfanTOOR\Console([
    'info' => ['bg_black', 'yellow'],
    'url'  => ['red', 'underline'],
]);

# Theme
$c->writeln("Modified theme >> info", "info");
$c->writeln("https://github.com/irfantoor/console", "url");
```
