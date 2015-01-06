<?php
/**
 *
 */
namespace Bramus\Ansi\ControlFunctions;

class Tab extends Base
{
    public function __construct($outputNow = false)
    {
        parent::__construct(Enums\C0::TAB, $outputNow);
    }
}
