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
            $this->reset();
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
    public function set($value)
    {
        $this->sequence = (string) $value;

        return $this;
    }

    /**
     * Reset the currently built ANSI sequence
     * @return Helper self, for chaining
     */
    public function reset()
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
     * Select Graphic Rendition
     * @param  array   $parameterByte Parameter byte to the SGR Escape Code
     * @param  boolean $outputNow     Echo the character right now, or add it to the sequence building?
     * @return Helper  self, for chaining
     */
    public function sgr($parameterByte = array(), $outputNow = false)
    {
        $sgr = new Escapecodes\Sgr($parameterByte);

        return $this->cs(ControlFunction::C1_ESC, $sgr);
    }
}
