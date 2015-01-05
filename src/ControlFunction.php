<?php
/**
 * ANSI Control Function
 *
 * An element of a character set that effects the recording, processing,
 * transmission, or interpretation of data, and that has a coded
 * representation consisting of one or more bit combinations.
 *
 */
namespace Bramus\Ansi;

class ControlFunction
{
    /**
     * Bell Control Charachter (\a)
     * @var string
     */
    const C1_BELL = "\007";

    /**
     * Backspace Control Charachter (\b)
     * @var string
     */
    const C1_BACKSPACE = "\010";

    /**
     * Tab Control Character (\t)
     * @var string
     */
    const C1_TAB = "\011";

    /**
     * Linefeed Control Character (\n)
     * @var string
     */
    const C1_LF = "\012";

    /**
     * Carriage Return Control Character (\r)
     * @var string
     */
    const C1_CR = "\015";

    /**
     * Escape Control Character
     * @var string
     */
    const C1_ESC = "\033";

    /**
     * The Control Character used
     * @var string
     */
    protected $controlCharacter;

    /**
     * ANSI Control Function
     * @param string  $controlCharacter The Control Character to use
     * @param boolean $outputNow        Output the resulting ANSI Code right now?
     */
    public function __construct($controlCharacter, $outputNow = false)
    {
        // Store the Control Character
        $this->setControlCharacter($controlCharacter);

        // Output now if requested
        if ($outputNow) {
            $this->e();
        }
    }

    /**
     * Set the control character
     * @param string $controlCharacter The Control Character
     */
    public function setControlCharacter($controlCharacter)
    {
        // @TODO: Check Validity
        $this->controlCharacter = $controlCharacter;

        return $this;
    }

    /**
     * Build and return the ANSI Code
     * @return string The ANSI Code
     */
    public function get()
    {
        return $this->controlCharacter;
    }

    /**
     * Echo the ANSI Code
     */
    public function e()
    {
        echo $this->get();

        return $this;
    }
}

// EOF
