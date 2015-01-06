<?php
/**
 * ANSI Control Function
 *
 * An element of a character set that effects the recording, processing,
 * transmission, or interpretation of data, and that has a coded
 * representation consisting of one or more bit combinations.
 *
 */
namespace Bramus\Ansi\ControlFunctions;

class Base
{
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
