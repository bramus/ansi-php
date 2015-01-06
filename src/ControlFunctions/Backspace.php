<?php
/**
 *
 */
namespace Bramus\Ansi\ControlFunctions;

class Backspace extends Base
{
    public function __construct($outputNow = false)
    {
        parent::__construct(Enums\C0::BACKSPACE, $outputNow);
    }
}
