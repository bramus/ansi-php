<?php
/**
 * ANSI Control Sequence
 *
 * A string of bit combinations starting with the control
 * function CONTROL SEQUENCE INTRODUCER (CSI), and used for
 * the coded representation of control functions with
 * or without parameters.
 */
namespace Bramus\Ansi;

class ControlSequence
{
    /**
     * A ControlFunction that acts as the Control Sequence Introducer (CSI)
     * @var ControlFunction
     */
    protected $controlSequenceIntroducer;

    /**
     * The Bit Combinations that succeed the ControlFunction
     * @var \Bramus\Ansi\Escapecodes\Base
     */
    protected $escapeCode;

    /**
     * ANSI Control Sequence
     * @param ControlFunction $csi        A ControlFunction that acts as the Control Sequence Introducer (CSI)
     * @param Object          $escapeCode The Bit Combinations to use (Parameter Byte, Intermediate Byte, Final Byte)
     * @param boolean         $outputNow  [description]
     */
    public function __construct($controlSequenceIntroducer, $escapeCode, $outputNow = false)
    {
        // Store datamembers
        $this->setControlSequenceIntroducer($controlSequenceIntroducer);
        $this->setEscapeCode($escapeCode);
    }

    /**
     * Set the control sequence introducer
     * @param  ControlFunction $controlSequenceIntroducer A ControlFunction that acts as the Control Sequence Introducer (CSI)
     * @return ControlSequence self, for chaining
     */
    public function setControlSequenceIntroducer($controlSequenceIntroducer)
    {
        // Make sure it's a ControlFunction instance
        if (is_string($controlSequenceIntroducer)) {
            $controlSequenceIntroducer = new ControlFunction($controlSequenceIntroducer);
        }

        // @TODO: Check Validity
        $this->controlSequenceIntroducer = $controlSequenceIntroducer;

        return $this;
    }

    /**
     * Set the escape code
     * @param  \Bramus\Escapecodes\Base $escapeCode The Bit Combinations to use (Parameter Byte, Intermediate Byte, Final Byte)
     * @return ControlSequence          self, for chaining
     */
    public function setEscapeCode($escapeCode)
    {
        // @TODO: Check Validity
        $this->escapeCode = $escapeCode;

        return $this;
    }

    /**
     * Build and return the ANSI Code
     * @return string The ANSI Code
     */
    public function get()
    {
        return $this->controlSequenceIntroducer->get().'['.$this->escapeCode->get();
    }

    /**
     * Echo the ANSI Code
     */
    public function e()
    {
        echo $this->get();
    }
}

// EOF
