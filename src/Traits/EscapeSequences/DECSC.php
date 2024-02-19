<?php

namespace Bramus\Ansi\Traits\EscapeSequences;

/**
 * Trait containing the DECSC (Save Cursor Position) Escape Function Shorthands
 * This is the DEC (VT100) code to save current cursor position
 */
trait DECSC
{
    /**
     * Save cursor position
     * @return Ansi  self, for chaining
     */
    public function decsc()
    {
        // Write data to the writer
        $this->writer->write(
            new \Bramus\Ansi\ControlSequences\EscapeSequences\DECSC()
        );

        // Afford chaining
        return $this;
    }

    /**
     * More readable alias for DECSC
     * @return Ansi    self, for chaining
     */
    public function saveCursorPosition()
    {
        return $this->decsc();
    }
}
