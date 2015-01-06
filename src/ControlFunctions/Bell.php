<?php
/**
 *
 */
namespace Bramus\Ansi\ControlFunctions;

class Bell extends Base
{
    public function __construct($outputNow = false)
    {
        parent::__construct(Enums\C0::BELL, $outputNow);
    }
}
