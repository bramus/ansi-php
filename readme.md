# ANSI PHP

ANSI Control Functions and ANSI Control Sequences for PHP CLI Apps

Built by Bramus! - [https://www.bram.us/](https://www.bram.us/)

[![Build Status](https://api.travis-ci.org/bramus/ansi-php.png)](http://travis-ci.org/bramus/ansi-php)

## About

`bramus/ansi-php` is a set of classes to working with ANSI Control Functions and ANSI Control Sequences on text based terminals.

- ANSI Control Functions control an action such as line spacing, paging, or data flow.
- ANSI Control Sequences allow one to clear the screen, move the cursor, set text colors, etc.

_(Sidenote: An “ANSI Escape Sequence” is a special type of “ANSI Control Sequence” which starts with the ESC ANSI Control Function. The terms are not interchangeable.)_

## Features

When it comes to ANSI Control Functions `bramus/ansi-php` supports:

- `BS`: Backspace
- `BEL`: Bell
- `CR`: Carriage Return
- `ESC`: Escape
- `LF`: Line Feed
- `TAB`: Tab

When it comes to ANSI Escape Sequences `bramus/ansi-php` supports:

- SGR _(Select Graphic Rendition)_: Manipulate text styling (bold, underline, blink, colors, etc.).
- ED _(Erase Display)_: Erase (parts of) the display.
- EL _(Erase In Line)_: Erase (parts of) the current line.

Other Control Sequences – such as moving the cursor – are not (yet) supported.

An example library that uses `bramus/ansi-php` is [`bramus/monolog-colored-line-formatter`](https://github.com/bramus/monolog-colored-line-formatter). It uses `bramus/ansi-php`'s SGR support to colorize the output:

![Monolog Colored Line Formatter](https://raw.githubusercontent.com/bramus/monolog-colored-line-formatter/master/screenshots/colorscheme-default.gif)

## Prerequisites/Requirements

- PHP 5.4.0 or greater

## Installation

Installation is possible using Composer

```
composer require bramus/ansi-php ~2.0
```

## Usage

The easiest way to use _ANSI PHP_ is to use the bundled `Ansi` class which provides easy shorthands to working with `bramus/ansi-php`. If you're feeling adventurous, you're of course free to use the raw `ControlFunction` and `ControlSequence` classes.

The `Ansi` class is written in such a way that you can chain calls to one another. To achieve this `Ansi` stores all text built in a local variable `$sequence`. It is stored there until you retrieve it using the `get()` function. Alternatively use `e()` to echo the built contents.

### Quick example

```
use \Bramus\Ansi\Ansi;
use \Bramus\Ansi\ControlSequences\EscapeSequences\Enums\SGR;

// Create Ansi Instance
$ansi = new Ansi();

// Output some styled text on screen, along with a Line Feed and a Bell
echo $ansi->color(array(SGR::COLOR_FG_RED, SGR::COLOR_BG_WHITE))->blink()->text('My text will be white on a red background and I will be blinking. A bell is coming up ...')->nostyle()->lf()->bell()->get();
```

See more examples further down on how to use these.

### Core functions:

- `get()`: Get the currently built ANSI sequence
- `e()`: Output the currently built ANSI Sequence on screen (using `echo`)
- `text()`: Add a piece of text to the ANSI sequence
- `setSequence()`: Set the ANSI sequence to the given value
- `resetSequence()`: Reset the currently built ANSI sequence

### ANSI Control Function shorthands:

- `bell()`:  Add a Bell Control Character (`\a`) to the sequence
- `backspace()`:  Add a Backspace Control Character (`\b`) to the sequence
- `tab()`:  Add a Tab Control Character (`\t`) to the sequence
- `lf()`:  Add a Line Feed Control Character (`\n`) to the sequence
- `cr()`:  Add a Carriage Return Control Character (`\r`) to the sequence
- `esc()`:  Add a Escape Control Character to the sequence

### SGR ANSI Escape Sequence shorthands:

- `nostyle()` or `reset()`: Remove all text styling. (colors, bold, etc)
- `color()`: Set the foreground and/or backgroundcolor of the text. _(see further)_
- `bold()` or `bright()`: Bold: On. On some systems "Intensity: Bright"
- `normal()`: Bold: Off. On some systems "Intensity: Normal"
- `faint()`: Intensity: Faint. _(Not widely supported)_
- `italic()`: Italic: On. _(Not widely supported)_
- `underline()`: Underline: On.
- `blink()`: Blink: On.
- `negative()`: Inverse or Reverse. Swap foreground and background.
- `strikethrough()`: Strikethrough: On. _(Not widely supported)_

__IMPORTANT:__ Select Graphic Rendition works in such a way that text styling  you have set will remain active until you call `nostyle()` or `reset()` to return to the default styling.

### ED ANSI Escape Sequence shorthands:

- `eraseDisplay()`: Erase the entire screen and moves the cursor to home.
- `eraseDisplayUp()`: Erase the screen from the current line up to the top of the screen.
- `eraseDisplayDown()`: Erase the screen from the current line down to the bottom of the screen.

### EL ANSI Escape Sequence shorthands:

- `eraseLine()`: Erase the entire current line.
- `eraseLineToEOL()`: Erase from the current cursor position to the end of the current line.
- `eraseLineToSOL()`: Erases from the current cursor position to the start of the current line.


## Examples

### The Basics

```
// Create Ansi Instance
$ansi = new \Bramus\Ansi\Ansi();

// This will output a Bell
$ansi->bell()->e();

// This too will output a Bell
echo $ansi->bell()->get();

// This will output some text
$ansi->text('Hello World!')->e();
```

### Chaining

`bramus/ansi-php`'s wrapper `Ansi` class supports chaining.

```
// Create Ansi Instance
$ansi = new \Bramus\Ansi\Ansi();

// This will output a Line Feed, some text, a Bell, and a Line Feed
echo $ansi->lf()->text('hello')->bell()->lf()->get();

```
Don't forget to call `e()` or `get()` at the end.

### Styling Text: The Basics

```
$ansi = new \Bramus\Ansi\Ansi();
echo $ansi->bold()->underline()->text('I will be bold and underlined')->lf()->get();
```

__IMPORTANT__ Select Graphic Rendition works in such a way that text styling  you have set will remain active until you call `nostyle()` or `reset()` to return to the default styling.


```
$ansi = new \Bramus\Ansi\Ansi();

echo $ansi->bold()->underline()->text('I will be bold and underlined')->lf()->get();
echo $ansi->text('I will also be bold because nostyle() has not been called yet')->lf()->get();
echo $ansi->nostyle()->blink()->text('I will be blinking')->nostyle()->lf()->get();
echo $ansi->text('I will be normal because nostyle() was called on the previous line')->get();

```

### Styling Text: Colors

Colors, and other text styling options, are defined as contants on `\Bramus\Ansi\ControlSequences\EscapeSequences\Enums\SGR`.

#### Foreground (Text) Colors

- `SGR::COLOR_FG_BLACK`: Black Foreground Color
- `SGR::COLOR_FG_RED`: Red Foreground Color
- `SGR::COLOR_FG_GREEN`: Green Foreground Color
- `SGR::COLOR_FG_YELLOW`: Yellow Foreground Color
- `SGR::COLOR_FG_BLUE`: Blue Foreground Color
- `SGR::COLOR_FG_PURPLE`: Purple Foreground Color
- `SGR::COLOR_FG_CYAN`: Cyan Foreground Color
- `SGR::COLOR_FG_WHITE`: White Foreground Color
- `SGR::COLOR_FG_BLACK_BRIGHT`: Black Foreground Color (Bright)
- `SGR::COLOR_FG_RED_BRIGHT`: Red Foreground Color (Bright)
- `SGR::COLOR_FG_GREEN_BRIGHT`: Green Foreground Color (Bright)
- `SGR::COLOR_FG_YELLOW_BRIGHT`: Yellow Foreground Color (Bright)
- `SGR::COLOR_FG_BLUE_BRIGHT`: Blue Foreground Color (Bright)
- `SGR::COLOR_FG_PURPLE_BRIGHT`: Purple Foreground Color (Bright)
- `SGR::COLOR_FG_CYAN_BRIGHT`: Cyan Foreground Color (Bright)
- `SGR::COLOR_FG_WHITE_BRIGHT`: White Foreground Color (Bright)
- `SGR::COLOR_FG_RESET': Default Foreground Color

#### Background Colors

- `SGR::COLOR_BG_BLACK`: Black Background Color
- `SGR::COLOR_BG_RED`: Red Background Color
- `SGR::COLOR_BG_GREEN`: Green Background Color
- `SGR::COLOR_BG_YELLOW`: Yellow Background Color
- `SGR::COLOR_BG_BLUE`: Blue Background Color
- `SGR::COLOR_BG_PURPLE`: Purple Background Color
- `SGR::COLOR_BG_CYAN`: Cyan Background Color
- `SGR::COLOR_BG_WHITE`: White Background Color
- `SGR::COLOR_BG_BLACK_BRIGHT`: Black Background Color (Bright)
- `SGR::COLOR_BG_RED_BRIGHT`: Red Background Color (Bright)
- `SGR::COLOR_BG_GREEN_BRIGHT`: Green Background Color (Bright)
- `SGR::COLOR_BG_YELLOW_BRIGHT`: Yellow Background Color (Bright)
- `SGR::COLOR_BG_BLUE_BRIGHT`: Blue Background Color (Bright)
- `SGR::COLOR_BG_PURPLE_BRIGHT`: Purple Background Color (Bright)
- `SGR::COLOR_BG_CYAN_BRIGHT`: Cyan Background Color (Bright)
- `SGR::COLOR_BG_WHITE_BRIGHT`: White Background Color (Bright)
- `SGR::COLOR_BG_RESET': Default Background Color

Pass one of these into `$ansi->color()` and the color will be set.

```
use \Bramus\Ansi\ControlSequences\EscapeSequences\Enums\SGR;

$ansi = new \Bramus\Ansi\Ansi();

echo $ansi->color(SGR::COLOR_FG_RED)->text('I will be red')->nostyle()->get();
```

To set the foreground and background color in one call, pass them using an array to `$ansi->color()`
```
use \Bramus\Ansi\ControlSequences\EscapeSequences\Enums\SGR;

$ansi = new \Bramus\Ansi\Ansi();

echo $ansi->color(array(SGR::COLOR_FG_RED, SGR::COLOR_BG_WHITE))->blink()->text('I will be white on a red background and will be blinking')->nostyle()->get();
```

## Unit Testing

`bramus/ansi-php` ships with unit tests using [PHPUnit](https://github.com/sebastianbergmann/phpunit/).

- If PHPUnit is installed globally run `phpunit` to run the tests.

- If PHPUnit is not installed globally, install it locally throuh composer by running `composer install --dev`. Run the tests themselves by calling `vendor/bin/phpunit`.

Unit tests are also automatically run [on Travis CI](http://travis-ci.org/bramus/ansi-php)

## License

`bramus/ansi-php` is released under the MIT public license. See the enclosed `LICENSE` for details.

## ANSI References

- [http://en.wikipedia.org/wiki/ANSI_escape_code](http://en.wikipedia.org/wiki/ANSI_escape_code)
- [http://www.ecma-international.org/publications/files/ECMA-ST/Ecma-048.pdf](http://www.ecma-international.org/publications/files/ECMA-ST/Ecma-048.pdf)
- [http://wiki.bash-hackers.org/scripting/terminalcodes](http://wiki.bash-hackers.org/scripting/terminalcodes)
- [http://web.mit.edu/gnu/doc/html/screen_10.html](http://web.mit.edu/gnu/doc/html/screen_10.html)
- [http://www.isthe.com/chongo/tech/comp/ansi_escapes.html](http://www.isthe.com/chongo/tech/comp/ansi_escapes.html)
- [http://www.termsys.demon.co.uk/vtansi.htm](http://www.termsys.demon.co.uk/vtansi.htm)
- [http://rrbrandt.dee.ufcg.edu.br/en/docs/ansi/](http://rrbrandt.dee.ufcg.edu.br/en/docs/ansi/)
- [http://tldp.org/HOWTO/Bash-Prompt-HOWTO/c327.html](http://tldp.org/HOWTO/Bash-Prompt-HOWTO/c327.html)
