# ANSI PHP

ANSI Control Functions and ANSI Control Sequences for PHP CLI Apps

Built by Bramus! - [https://www.bram.us/](https://www.bram.us/)

[![Build Status](https://api.travis-ci.org/bramus/ansi-php.png)](http://travis-ci.org/bramus/ansi-php)

## About

`bramus/ansi-php` is a set of classes to working with ANSI Control Functions and ANSI Control Sequences _(ANSI Escape Sequences)_ on text based terminals.

ANSI Control Sequences allow on to clear the screen, move the cursor, set text colors, etc.

At this time `bramus/ansi-php` only support the SGR (Select Graphic Rendition) Control Sequence, which affords one to manipulate text styling (bold, underline, blink, colors, etc.).


## Prerequisites/Requirements

- PHP 5.3.3 or greater

## Installation

Installation is possible using Composer

```
composer require bramus/ansi-php ~1.0
```

## Usage

The easiest way to use _ANSI PHP_ is to use the bundled `Helper` class as it provides easy shorthands. If you're feeling adventurous, you're of course free to use the raw `ControlFunction` and `ControlSequence` classes.

The `Helper` class is written in such a way that you can chain calls to one another. To achieve this `Helper` stores all text built in a local variable `$sequence` until you retrieve it using the `get()` function. Alternatively use `e()` to echo the built contents.

See the examples further down on how to use these.

Core functions provided on `Helper`:

- `get()`: Get the currently built ANSI sequence
- `e()`: Output the currently built ANSI Sequence on screen (using `echo`)
- `text()`: Add a piece of text to the ANSI sequence
- `setSequence()`: Set the ANSI sequence to the given value
- `resetSequence()`: Reset the currently built ANSI sequence

_ANSI Control Functions_ shorthands provided on `Helper`:

- `bell()`:  Add a Bell Control Character (`\a`) to the sequence
- `backspace()`:  Add a Backspace Control Character (`\b`) to the sequence
- `tab()`:  Add a Tab Control Character (`\t`) to the sequence
- `lf()`:  Add a Line Feed Control Character (`\n`) to the sequence
- `cr()`:  Add a Carriage Return Control Character (`\r`) to the sequence
- `esc()`:  Add a Escape Control Character to the sequence

_ANSI Control Sequence_ shorthands provided on `Helper`:

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

__IMPORTANT__ Select Graphic Rendition works in such a way that text styling  you have set will remain active until you call `nostyle()` or `reset()` to return to the default styling.

## Examples

### The Basics

```
// Create Helper Instance
$h = new \Bramus\Ansi\Helper();

// This will output a Bell
$h->bell()->e();

// This too will output a Bell
echo $h->bell()->get();

// This will output some text
$h->text('Hello World!')->e();
```

### Chaining

`bramus/ansi-php`'s `Helper` class supports chaining.

```
// Create Helper Instance
$h = new \Bramus\Ansi\Helper();

// This will output a Line Feed, some text, a Bell, and a Line Feed
echo $h->lf()->text('hello')->bell()->lf()->get();

```
Don't forget to call `e()` or `get()` at the end.

### Styling Text: The Basics

```
$h = new \Bramus\Ansi\Helper();
echo $h->bold()->underline()->text('I will be bold and underlined')->lf()->get();
```

__IMPORTANT__ Select Graphic Rendition works in such a way that text styling  you have set will remain active until you call `nostyle()` or `reset()` to return to the default styling.


```
$h = new \Bramus\Ansi\Helper();

echo $h->bold()->underline()->text('I will be bold and underlined')->lf()->get();
echo $h->text('I will also be bold because nostyle() has not been called yet')->lf()->get();
echo $h->nostyle()->blink()->text('I will be blinking')->nostyle()->lf()->get();
echo $h->text('I will be normal because nostyle() was called on the previous line')->get();

```

### Styling Text: Colors

Colors, and other text styling options, are defined as contants on `\Bramus\Ansi\Escapecodes\Sgr`.

#### Foreground Colors

- `Sgr::COLOR_FG_BLACK`: Black Foreground Color
- `Sgr::COLOR_FG_RED`: Red Foreground Color
- `Sgr::COLOR_FG_GREEN`: Green Foreground Color
- `Sgr::COLOR_FG_YELLOW`: Yellow Foreground Color
- `Sgr::COLOR_FG_BLUE`: Blue Foreground Color
- `Sgr::COLOR_FG_PURPLE`: Purple Foreground Color
- `Sgr::COLOR_FG_CYAN`: Cyan Foreground Color
- `Sgr::COLOR_FG_WHITE`: White Foreground Color
- `Sgr::COLOR_FG_BLACK_BRIGHT`: Black Foreground Color (Bright)
- `Sgr::COLOR_FG_RED_BRIGHT`: Red Foreground Color (Bright)
- `Sgr::COLOR_FG_GREEN_BRIGHT`: Green Foreground Color (Bright)
- `Sgr::COLOR_FG_YELLOW_BRIGHT`: Yellow Foreground Color (Bright)
- `Sgr::COLOR_FG_BLUE_BRIGHT`: Blue Foreground Color (Bright)
- `Sgr::COLOR_FG_PURPLE_BRIGHT`: Purple Foreground Color (Bright)
- `Sgr::COLOR_FG_CYAN_BRIGHT`: Cyan Foreground Color (Bright)
- `Sgr::COLOR_FG_WHITE_BRIGHT`: White Foreground Color (Bright)

#### Background Colors

- `Sgr::COLOR_BG_BLACK`: Black Background Color
- `Sgr::COLOR_BG_RED`: Red Background Color
- `Sgr::COLOR_BG_GREEN`: Green Background Color
- `Sgr::COLOR_BG_YELLOW`: Yellow Background Color
- `Sgr::COLOR_BG_BLUE`: Blue Background Color
- `Sgr::COLOR_BG_PURPLE`: Purple Background Color
- `Sgr::COLOR_BG_CYAN`: Cyan Background Color
- `Sgr::COLOR_BG_WHITE`: White Background Color
- `Sgr::COLOR_BG_BLACK_BRIGHT`: Black Background Color (Bright)
- `Sgr::COLOR_BG_RED_BRIGHT`: Red Background Color (Bright)
- `Sgr::COLOR_BG_GREEN_BRIGHT`: Green Background Color (Bright)
- `Sgr::COLOR_BG_YELLOW_BRIGHT`: Yellow Background Color (Bright)
- `Sgr::COLOR_BG_BLUE_BRIGHT`: Blue Background Color (Bright)
- `Sgr::COLOR_BG_PURPLE_BRIGHT`: Purple Background Color (Bright)
- `Sgr::COLOR_BG_CYAN_BRIGHT`: Cyan Background Color (Bright)
- `Sgr::COLOR_BG_WHITE_BRIGHT`: White Background Color (Bright)

Pass one of these into `$h->color()` and the color will be set.

```
use \Bramus\Ansi\Escapecodes\Sgr;

$h = new \Bramus\Ansi\Helper();

echo $h->color(Sgr::COLOR_FG_RED)->text('I will be red')->nostyle()->get();
```

To set the foreground and background color in one call, pass them using an array to `$h->color()`
```
use \Bramus\Ansi\Escapecodes\Sgr;

$h = new \Bramus\Ansi\Helper();

echo $h->color(array(Sgr::COLOR_FG_RED, Sgr::COLOR_BG_WHITE))->blink()->text('I will be white on a red background and will be blinking')->nostyle()->get();
```

## Unit Testing

`bramus/ansi-php` ships with unit tests using [PHPUnit](https://github.com/sebastianbergmann/phpunit/).

- If PHPUnit is installed globally run `phpunit` to run the tests.

- If PHPUnit is not installed globally, install it locally throuh composer by running `composer install --dev`. Run the tests themselves by calling `vendor/bin/phpunit`.

Unit tests are also automatically run [on Travis CI](http://travis-ci.org/bramus/ansi-php)

## License

`bramus/ansi-php` is released under the MIT public license. See the enclosed `LICENSE` for details.

## References

- [http://en.wikipedia.org/wiki/ANSI_escape_code]http://en.wikipedia.org/wiki/ANSI_escape_code
- [http://www.ecma-international.org/publications/files/ECMA-ST/Ecma-048.pdf]http://www.ecma-international.org/publications/files/ECMA-ST/Ecma-048.pdf
- [http://wiki.bash-hackers.org/scripting/terminalcodes]http://wiki.bash-hackers.org/scripting/terminalcodes
- [http://www.isthe.com/chongo/tech/comp/ansi_escapes.html]http://www.isthe.com/chongo/tech/comp/ansi_escapes.html
- [http://www.termsys.demon.co.uk/vtansi.htm]http://www.termsys.demon.co.uk/vtansi.htm