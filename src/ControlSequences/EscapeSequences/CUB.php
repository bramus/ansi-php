<?php
/**
 * CUB - CURSOR BACK
 *
 * Cursor movement/reporting is acutally part of CSI ("Control
 * Sequence Introducer") but since ED and EL is already broken
 * out I broke out just the cursor stuff to this class too.
 */
namespace Bramus\Ansi\ControlSequences\EscapeSequences;

class CUB extends Base
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
            \Bramus\Ansi\ControlSequences\EscapeSequences\Enums\FinalByte::CUB
        );
    }
}
