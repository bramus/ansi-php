<?php
/**
 *
 */
namespace Bramus\Ansi\ControlFunctions;

class CarriageReturn extends Base
{
    public function __construct($outputNow = false)
    {
        parent::__construct(Enums\C0::CR, $outputNow);
    }
}
