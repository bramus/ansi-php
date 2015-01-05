<?php
/**
 * Helper Class to work with \Bramus\Ansi more easily
 */
namespace Bramus\Ansi;

class Helper
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
     * @return Helper  self, for chaining
     */
    public function e($resetAfterWards = true)
    {
        echo $this->get($resetAfterWards);

        return $this;
    }

    /**
     * Set the ANSI sequence to the given value
     * @param  string $value The value to set it to
     * @return Helper self, for chaining
     */
    public function setSequence($value)
    {
        $this->sequence = (string) $value;

        return $this;
    }

    /**
     * Reset the currently built ANSI sequence
     * @return Helper self, for chaining
     */
    public function resetSequence()
    {
        $this->sequence = '';

        return $this;
    }

    /**
     * Create the given Control Character
     * @param  string  $controlCharacter The Control Character
     * @param  boolean $outputNow        Echo the character right now, or add it to the sequence building?
     * @return Helper  self, for chaining
     */
    private function cf($controlCharacter, $outputNow = false)
    {
        $c = (new ControlFunction($controlCharacter))->get();
        if (!$outputNow) {
            $this->sequence .= $c;
        } else {
            echo $c;
        }

        return $this;
    }

    /**
     * Create the given Control Sequence
     * @param  string  $controlCharacter The Control Character
     * @param  boolean $outputNow        Echo the character right now, or add it to the sequence building?
     * @return Helper  self, for chaining
     */
    private function cs($controlCharacter, $escapeCode, $outputNow = false)
    {
        $c = (new ControlSequence($controlCharacter, $escapeCode))->get();
        if (!$outputNow) {
            $this->sequence .= $c;
        } else {
            echo $c;
        }

        return $this;
    }

    /**
     * Add a piece of text to the sequence / echo it on screen
     * @param  string  $text      The text to add
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Helper  self, for chaining
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
     * @return Helper  self, for chaining
     */
    public function bell($outputNow = false)
    {
        return $this->cf(ControlFunction::C1_BELL, $outputNow);
    }

    /**
     * Add a Backspace Control Character to the sequence / echo it on screen
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Helper  self, for chaining
     */
    public function backspace($outputNow = false)
    {
        return $this->cf(ControlFunction::C1_BACKSPACE, $outputNow);
    }

    /**
     * Add a Tab Control Character to the sequence / echo it on screen
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Helper  self, for chaining
     */
    public function tab($outputNow = false)
    {
        return $this->cf(ControlFunction::C1_TAB, $outputNow);
    }

    /**
     * Add a Line Feed Control Character to the sequence / echo it on screen
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Helper  self, for chaining
     */
    public function lf($outputNow = false)
    {
        return $this->cf(ControlFunction::C1_LF, $outputNow);
    }

    /**
     * Add a Carriage Return Control Character to the sequence / echo it on screen
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Helper  self, for chaining
     */
    public function cr($outputNow = false)
    {
        return $this->cf(ControlFunction::C1_CR, $outputNow);
    }

    /**
     * Manually specify the Select Graphic Rendition parameters
     * @param  array   $parameterByte Parameter byte to the SGR Escape Code
     * @param  boolean $outputNow     Echo the character right now, or add it to the sequence building?
     * @return Helper  self, for chaining
     */
    public function sgr($parameterByte = array(), $outputNow = false)
    {
        $sgr = new Escapecodes\Sgr($parameterByte);

        return $this->cs(ControlFunction::C1_ESC, $sgr);
    }

    /**
     * Shorthand to remove all text styling (colors, bold, etc)
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Helper  self, for chaining
     */
    public function nostyle($outputNow = false)
    {
        return $this->sgr(array(Escapecodes\Sgr::STYLE_NONE), $outputNow);
    }

    /**
     * Shorthand to remove all text styling (colors, bold, etc)
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Helper  self, for chaining
     */
    public function reset($outputNow = false)
    {
        return $this->nostyle($outputNow);
    }

    /**
     * Shorthand to set the color.
     * @param  array   $color     The color you want to set. Use an array filled with Sgr::COLOR_* constants
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Helper  self, for chaining
     */
    public function color($color = array(), $outputNow = false)
    {
        return $this->sgr($color, $outputNow);
    }

    /**
     * Shorthand to set make text styling to bold (on some systems bright intensity)
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Helper  self, for chaining
     */
    public function bold($outputNow = false)
    {
        return $this->sgr(array(Escapecodes\Sgr::STYLE_BOLD), $outputNow);
    }

    /**
     * Shorthand to set the text intensity to bright (on some systems bold)
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Helper  self, for chaining
     */
    public function bright($outputNow = false)
    {
        return $this->sgr(array(Escapecodes\Sgr::STYLE_INTENSITY_BRIGHT), $outputNow);
    }

    /**
     * Shorthand to set the text styling to normal (no bold/bright)
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Helper  self, for chaining
     */
    public function normal($outputNow = false)
    {
        return $this->sgr(array(Escapecodes\Sgr::STYLE_INTENSITY_NORMAL), $outputNow);
    }

    /**
     * (Not widely supported) Shorthand to set the text intensity to faint
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Helper  self, for chaining
     */
    public function faint($outputNow = false)
    {
        return $this->sgr(array(Escapecodes\Sgr::STYLE_INTENSITY_FAINT), $outputNow);
    }

    /**
     * (Not widely supported) Shorthand to set the text styling to italic
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Helper  self, for chaining
     */
    public function italic($outputNow = false)
    {
        return $this->sgr(array(Escapecodes\Sgr::STYLE_ITALIC), $outputNow);
    }

    /**
     * Shorthand to set the text styling to underline
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Helper  self, for chaining
     */
    public function underline($outputNow = false)
    {
        return $this->sgr(array(Escapecodes\Sgr::STYLE_UNDERLINE), $outputNow);
    }

    /**
     * Shorthand to set the text styling to blink
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Helper  self, for chaining
     */
    public function blink($outputNow = false)
    {
        return $this->sgr(array(Escapecodes\Sgr::STYLE_BLINK), $outputNow);
    }

    /**
     * Shorthand to set the text styling to reserved (viz. swap background & foreground color)
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Helper  self, for chaining
     */
    public function negative($outputNow = false)
    {
        return $this->sgr(array(Escapecodes\Sgr::STYLE_NEGATIVE), $outputNow);
    }

    /**
     * (Not widely supported) Shorthand to set the text styling to strikethrough
     * @param  boolean $outputNow Echo the character right now, or add it to the sequence building?
     * @return Helper  self, for chaining
     */
    public function strikethrough($outputNow = false)
    {
        return $this->sgr(array(Escapecodes\Sgr::STYLE_STRIKETHROUGH), $outputNow);
    }
}
