<?php
/**
 * Escape Codes to use in Control Sequences
 * Although it is possible, it is not recommended to work with this class directly. Used one of the derived classes instead.
 */
namespace Bramus\Ansi\Escapecodes;

class Base
{
    /**
     * Select Graphic Rendition
     *
     * SGR is used to establish one or more graphic rendition aspects for
     * subsequent text. The established aspects remain in effect until the
     * next occurrence of SGR in the data stream, depending on the setting
     * of the GRAPHIC RENDITION COMBINATION MODE (GRCM). Each graphic
     * rendition aspect is specified by a parameter value
     *
     * @var string
     */
    const FB_SGR = 'm';

    // @TODO: Add more Escape Code Final Bits
    // @see http://www.ecma-international.org/publications/files/ECMA-ST/Ecma-048.pdf


    /**
     * Final Byte: The bit combination that terminates an escape sequence or a control sequence.
     * @var string
     */
    protected $finalByte;

    /**
     * Parameter Byte: In a control sequence, a bit combination that may occur between the ControlFunction CSI and the Final Byte, or between CSI and an Intermediate Byte.
     * @var array
     */
    protected $parameterByte = array();

    /**
     * Intermediate Byte: In a control sequence, a bit combination that may occur between the ControlFunction CSI and the Final Byte, or between a Parameter Byte and the Final Byte.
     * @var array
     */
    protected $intermediateByte = array();

    /**
     * Escape Code
     * @param array  $parameterByte    In a control sequence, a bit combination that may occur between the ControlFunction CSI and the Final Byte, or between CSI and an Intermediate Byte.
     * @param array  $intermediateByte In a control sequence, a bit combination that may occur between the ControlFunction CSI and the Final Byte, or between a Parameter Byte and the Final Byte.
     * @param string $finalByte        The bit combination that terminates an escape sequence or a control sequence.
     */
    public function __construct($parameterByte, $intermediateByte, $finalByte)
    {
        // Store Data
        if (sizeof($parameterByte) > 0) {
            $this->setParameterByte((array) $parameterByte);
        }

        if (sizeof($intermediateByte) > 0) {
            $this->setIntermediateByte((array) $intermediateByte);
        }

        $this->setFinalByte($finalByte);
    }

    /**
     * Build and return the ANSI Code
     * @return string The ANSI Code
     */
    public function get()
    {
        $toReturn = '';

        // Add Parameter Byte
        if (sizeof($this->parameterByte) > 0) {
            $toReturn .= implode($this->parameterByte, ';');
        }

        if (sizeof($this->intermediateByte) > 0) {
            $toReturn .= implode($this->intermediateByte, ';'); // @TODO: Verify that ';' is the glue for intermediate bytes
        }

        $toReturn .= $this->finalByte;

        return $toReturn;
    }

    /**
     * Echo the ANSI Code
     */
    public function e()
    {
        echo $this->get();
    }

    /**
     * Add a Parameter Byte
     * @param string $parameterByte The byte to add
     * @return Base                 self, for chaining
     */
    public function addParameterByte($parameterByte)
    {
        $this->parameterByte[] = (string) $parameterByte;

        return $this;
    }

    /**
     * Set the Parameter Byte
     * @param array $parameterByte The byte to add
     * @return Base                self, for chaining
     */
    public function setParameterByte($parameterByte)
    {
        foreach ((array) $parameterByte as $byte) {
            $this->addParameterByte($byte);
        }

        return $this;
    }

    /**
     * Add a Intermediate Byte
     * @param string $intermediateByte The byte to add
     * @return Base                    self, for chaining
     */
    public function addIntermediateByte($intermediateByte)
    {
        $this->intermediateByte[] = (string) $intermediateByte;

        return $this;
    }

    /**
     * Set the Intermediate Byte
     * @param array $parameterByte The byte to add
     * @return Base                self, for chaining
     */
    public function setIntermediateByte($intermediateByte)
    {
        foreach ((array) $intermediateByte as $byte) {
            $this->addIntermediateByte($byte);
        }

        return $this;
    }

    /**
     * Set the finalByte
     * @param string $finalByte The bit combination that terminates an escape sequence or a control sequence.
     * @return Base                    self, for chaining
     */
    public function setFinalByte($finalByte)
    {
        // @TODO Verify Validity
        $this->finalByte = $finalByte;

        return $this;
    }
}
