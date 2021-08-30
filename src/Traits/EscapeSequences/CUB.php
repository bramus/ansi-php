<?php

namespace Bramus\Ansi\Traits\EscapeSequences;

/**
 * Trait containing the CUB Escape Function Shorthands
 */
trait CUB
{
    /**
     * Manually use CUB (Move cursor back)
     * @param  array $parameterByte Parameter byte to the CUB Escape Code
     * @return Ansi  self, for chaining
     */
    public function cub($data = 1)
    {
        // Write data to the writer
        $this->writer->write(
            new \Bramus\Ansi\ControlSequences\EscapeSequences\CUB($data)
        );

        // Afford chaining
        return $this;
    }

    /**
     * Move the cursor back x positions
     * @param  integer  $positions the number of positions to move the cursor
     * @return Ansi     self, for chaining
     */
    public function cursorBack($positions = 1)
    {
        return $this->cub($positions);
    }
}
