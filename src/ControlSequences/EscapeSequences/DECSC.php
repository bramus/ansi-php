<?php
/**
 * DECSC - The DEC way to save cursor position
 * 
 */
namespace Bramus\Ansi\ControlSequences\EscapeSequences;

class DECSC extends Base
{
    /**
     * DECSC - Save Cursor Position (the DEC/VT100 way)
     */
    public function __construct()
    {
        // Call Parent Constructor (which will store finalByte)
        parent::__construct(
            \Bramus\Ansi\ControlSequences\EscapeSequences\Enums\FinalByte::DECSC
        );
    }
}
