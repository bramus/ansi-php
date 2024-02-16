<?php
/**
 * DECRC - RESTORE CURSOR POSITION
 * 
 */
namespace Bramus\Ansi\ControlSequences\EscapeSequences;

class DECRC extends Base
{
    /**
     * DECRC - Restore Cursor Position (the DEC/VT100 way)
     */
    public function __construct()
    {
        // Call Parent Constructor (which will store finalByte)
        parent::__construct(
            \Bramus\Ansi\ControlSequences\EscapeSequences\Enums\FinalByte::DECRC
        );
    }
}
