<?php

namespace Bramus\Ansi\Traits\EscapeSequences;

/**
 * Trait containing the DECRC (Restore Cursor Position) Escape Function Shorthands
 * This is the DEC (VT100) code to restore a saved cursor position
 */
trait DECRC
{
    /**
     * Save cursor position
     * @return Ansi  self, for chaining
     */
    public function decrc()
    {
        // Write data to the writer
        $this->writer->write(
            new \Bramus\Ansi\ControlSequences\EscapeSequences\DECRC()
        );

        // Afford chaining
        return $this;
    }

    /**
     * More readable alias for DECRC
     * @return Ansi    self, for chaining
     */
    public function restoreCursorPosition()
    {
        return $this->decrc();
    }
}
