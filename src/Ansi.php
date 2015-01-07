<?php
/**
 * Wrapper Class to work with \Bramus\Ansi more easily
 */
namespace Bramus\Ansi;

class Ansi
{
    /**
     * The sequence of ANSI Codes one is building
     * @var string
     */
    private $sequence = '';

    /**
     * Get the currently built sequence
     * @param  boolean $resetAfterWards Reset the currently built sequence after returning it?
     * @return [type]  The ANSI Sequence Built
     */
    public function get($resetAfterWards = true)
    {
        $sequence = $this->sequence;

        if ($resetAfterWards === true) {
            $this->resetSequence();
        }

        return $sequence;
    }

    /**
     * Output the currently built ANSI Sequence on screen
     * @param  boolean $resetAfterWards Reset the currently built sequence after returning it?
     * @return Ansi    self, for chaining
     */
    public function e($resetAfterWards = true)
    {
        echo $this->get($resetAfterWards);

        return $this;
    }

    /**
     * Set the ANSI sequence to the given value
     * @param  string $value The value to set it to
     * @return Ansi   self, for chaining
     */
    public function setSequence($value)
    {
        $this->sequence = (string) $value;

        return $this;
    }

    /**
     * Reset the currently built ANSI sequence
     * @return Ansi self, for chaining
     */
    public function resetSequence()
    {
        $this->sequence = '';

        return $this;
    }

    /**
     *
     * @param  Object  $c         ...
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Ansi    self, for chaining
     */
    private function appendToSequenceOrOutputNow($c, $outputNow = false)
    {
        if (!$outputNow) {
            $this->sequence .= $c->get();
        } else {
            $c->e();
        }

        return $this;
    }

    /**
     * Add a piece of text to the sequence / echo it on screen
     * @param  string  $text      The text to add
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Ansi    self, for chaining
     */
    public function text($text, $outputNow = false)
    {
        if (!$outputNow) {
            $this->sequence .= (string) $text;
        } else {
            echo $text;
        }

        return $this;
    }

    /**
     * Add a Bell Control Character to the sequence / echo it on screen
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Ansi    self, for chaining
     */
    public function bell($outputNow = false)
    {
        return $this->appendToSequenceOrOutputNow(new \Bramus\Ansi\ControlFunctions\Bell());
    }

    /**
     * Add a Backspace Control Character to the sequence / echo it on screen
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Ansi    self, for chaining
     */
    public function backspace($outputNow = false)
    {
        return $this->appendToSequenceOrOutputNow(new \Bramus\Ansi\ControlFunctions\Backspace());
    }

    /**
     * Add a Tab Control Character to the sequence / echo it on screen
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Ansi    self, for chaining
     */
    public function tab($outputNow = false)
    {
        return $this->appendToSequenceOrOutputNow(new \Bramus\Ansi\ControlFunctions\Tab());
    }

    /**
     * Add a Line Feed Control Character to the sequence / echo it on screen
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Ansi    self, for chaining
     */
    public function lf($outputNow = false)
    {
        return $this->appendToSequenceOrOutputNow(new \Bramus\Ansi\ControlFunctions\LineFeed());
    }

    /**
     * Add a Carriage Return Control Character to the sequence / echo it on screen
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Ansi    self, for chaining
     */
    public function cr($outputNow = false)
    {
        return $this->appendToSequenceOrOutputNow(new \Bramus\Ansi\ControlFunctions\CarriageReturn());
    }

    /**
     * Manually use SGR (Select Graphic Rendition)
     * @param  array   $parameterByte Parameter byte to the SGR Escape Code
     * @param  boolean $outputNow     Echo the character right now, or add it to the sequence building?
     * @return Ansi    self, for chaining
     */
    public function sgr($data = array(), $outputNow = false)
    {
        return $this->appendToSequenceOrOutputNow(
            new \Bramus\Ansi\ControlSequences\EscapeSequences\SGR($data)
        );
    }

    /**
     * Manually use ED (Select Graphic Rendition)
     * @param  array   $parameterByte Parameter byte to the SGR Escape Code
     * @param  boolean $outputNow     Echo the character right now, or add it to the sequence building?
     * @return Ansi    self, for chaining
     */
    public function ed($data, $outputNow = false)
    {
        return $this->appendToSequenceOrOutputNow(
            new \Bramus\Ansi\ControlSequences\EscapeSequences\ED($data)
        );
    }

    /**
     * Manually use EL (ERASE IN LINE)
     * @param  array   $parameterByte Parameter byte to the EL Escape Code
     * @param  boolean $outputNow     Echo the character right now, or add it to the sequence building?
     * @return Ansi    self, for chaining
     */
    public function el($data, $outputNow = false)
    {
        return $this->appendToSequenceOrOutputNow(
            new \Bramus\Ansi\ControlSequences\EscapeSequences\EL($data)
        );
    }

    /**
     * Shorthand to remove all text styling (colors, bold, etc)
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Ansi    self, for chaining
     */
    public function nostyle($outputNow = false)
    {
        return $this->sgr(array(ControlSequences\EscapeSequences\Enums\SGR::STYLE_NONE), $outputNow);
    }

    /**
     * Shorthand to remove all text styling (colors, bold, etc)
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Ansi    self, for chaining
     */
    public function reset($outputNow = false)
    {
        return $this->nostyle($outputNow);
    }

    /**
     * Shorthand to set the color.
     * @param  array   $color     The color you want to set. Use an array filled with ControlSequences\EscapeSequences\Enums\SGR::COLOR_* constants
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Ansi    self, for chaining
     */
    public function color($color = array(), $outputNow = false)
    {
        return $this->sgr($color, $outputNow);
    }

    /**
     * Shorthand to set make text styling to bold (on some systems bright intensity)
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Ansi    self, for chaining
     */
    public function bold($outputNow = false)
    {
        return $this->sgr(array(ControlSequences\EscapeSequences\Enums\SGR::STYLE_BOLD), $outputNow);
    }

    /**
     * Shorthand to set the text intensity to bright (on some systems bold)
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Ansi    self, for chaining
     */
    public function bright($outputNow = false)
    {
        return $this->sgr(array(ControlSequences\EscapeSequences\Enums\SGR::STYLE_INTENSITY_BRIGHT), $outputNow);
    }

    /**
     * Shorthand to set the text styling to normal (no bold/bright)
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Ansi    self, for chaining
     */
    public function normal($outputNow = false)
    {
        return $this->sgr(array(ControlSequences\EscapeSequences\Enums\SGR::STYLE_INTENSITY_NORMAL), $outputNow);
    }

    /**
     * (Not widely supported) Shorthand to set the text intensity to faint
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Ansi    self, for chaining
     */
    public function faint($outputNow = false)
    {
        return $this->sgr(array(ControlSequences\EscapeSequences\Enums\SGR::STYLE_INTENSITY_FAINT), $outputNow);
    }

    /**
     * (Not widely supported) Shorthand to set the text styling to italic
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Ansi    self, for chaining
     */
    public function italic($outputNow = false)
    {
        return $this->sgr(array(ControlSequences\EscapeSequences\Enums\SGR::STYLE_ITALIC), $outputNow);
    }

    /**
     * Shorthand to set the text styling to underline
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Ansi    self, for chaining
     */
    public function underline($outputNow = false)
    {
        return $this->sgr(array(ControlSequences\EscapeSequences\Enums\SGR::STYLE_UNDERLINE), $outputNow);
    }

    /**
     * Shorthand to set the text styling to blink
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Ansi    self, for chaining
     */
    public function blink($outputNow = false)
    {
        return $this->sgr(array(ControlSequences\EscapeSequences\Enums\SGR::STYLE_BLINK), $outputNow);
    }

    /**
     * Shorthand to set the text styling to reserved (viz. swap background & foreground color)
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Ansi    self, for chaining
     */
    public function negative($outputNow = false)
    {
        return $this->sgr(array(ControlSequences\EscapeSequences\Enums\SGR::STYLE_NEGATIVE), $outputNow);
    }

    /**
     * (Not widely supported) Shorthand to set the text styling to strikethrough
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Ansi    self, for chaining
     */
    public function strikethrough($outputNow = false)
    {
        return $this->sgr(array(ControlSequences\EscapeSequences\Enums\SGR::STYLE_STRIKETHROUGH), $outputNow);
    }

    /**
     * Erase the screen from the current line up to the top of the screen
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Ansi    self, for chaining
     */
    public function eraseDisplayUp($outputNow = false)
    {
        return $this->ed(ControlSequences\EscapeSequences\Enums\ED::UP, $outputNow);
    }

    /**
     * Erase the screen from the current line down to the bottom of the screen
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Ansi    self, for chaining
     */
    public function eraseDisplayDown($outputNow = false)
    {
        return $this->ed(ControlSequences\EscapeSequences\Enums\ED::DOWN, $outputNow);
    }

    /**
     * Erase the entire screen and moves the cursor to home
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Ansi    self, for chaining
     */
    public function eraseDisplay($outputNow = false)
    {
        return $this->ed(ControlSequences\EscapeSequences\Enums\ED::ALL, $outputNow);
    }

    /**
     * Erase from the current cursor position to the end of the current line.
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Ansi    self, for chaining
     */
    public function eraseLineToEOL($outputNow = false)
    {
        return $this->el(ControlSequences\EscapeSequences\Enums\EL::TO_EOL, $outputNow);
    }

    /**
     * Erases from the current cursor position to the start of the current line.
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Ansi    self, for chaining
     */
    public function eraseLineToSOL($outputNow = false)
    {
        return $this->el(ControlSequences\EscapeSequences\Enums\EL::TO_SOL, $outputNow);
    }

    /**
     * Erase the entire current line.
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Ansi    self, for chaining
     */
    public function eraseLine($outputNow = false)
    {
        return $this->el(ControlSequences\EscapeSequences\Enums\EL::ALL, $outputNow);
    }
}
