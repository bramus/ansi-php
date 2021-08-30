<?php

namespace Bramus\Ansi\Traits\EscapeSequences;

/**
 * Trait containing the CUP Escape Function Shorthands
 */
trait CUP
{
    /**
     * Manually use CUP (Cursor position)
     * @param  array $parameterByte Parameter byte to the CUP Escape Code
     * @return Ansi  self, for chaining
     */
    public function cup($data = 1)
    {
        // Write data to the writer
        $this->writer->write(
            new \Bramus\Ansi\ControlSequences\EscapeSequences\CUP($data)
        );

        // Afford chaining
        return $this;
    }

    /**
     * Move the cursor to coordinates x, y
     * @param  array   $coords  Array containing the x and y coordinates to move the cursor to
     * @return Ansi    self, for chaining
     */
    public function cursorPosition($coords = [1,1])
    {
        return $this->cup($coords);
    }
}
