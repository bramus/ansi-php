<?php
/**
 * CUF - CURSOR FORWARD
 *
 * Moves the cursor
 */

namespace Bramus\Ansi\ControlSequences\EscapeSequences;

class CUF extends Base
{
    // This EscapeSequence has ParameterByte(s)
    use \Bramus\Ansi\ControlSequences\Traits\HasParameterBytes;

    /**
     * SGR - SELECT GRAPHIC RENDITION
     * @param mixed   $parameterBytes The Parameter Bytes
     */
    public function __construct($parameterBytes = null)
    {
        // Store the parameter bytes
        $this->setParameterBytes($parameterBytes);

        // Call Parent Constructor (which will store finalByte)
        parent::__construct(
            \Bramus\Ansi\ControlSequences\EscapeSequences\Enums\FinalByte::CUF
        );
    }
}
