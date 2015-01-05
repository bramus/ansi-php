<?php

use \Bramus\Ansi\ControlFunction;
use \Bramus\Ansi\Escapecodes\Sgr;
use \Bramus\Ansi\Helper;

class ControlSequenceTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->helper = new Helper();
    }

    protected function tearDown()
    {
        // ...
    }

    public function testInstantiation()
    {
        $this->assertInstanceOf('\Bramus\Ansi\Helper', $this->helper);
    }

    public function testSgr()
    {
        $test = $this->helper->sgr(array(Sgr::COLOR_FG_RED, Sgr::STYLE_BLINK, Sgr::STYLE_BOLD))->text('te')->sgr(array(Sgr::COLOR_BG_GREEN))->text('st')->sgr()->get();

        $this->assertEquals(
            $test,
            ControlFunction::C1_ESC.'['.Sgr::COLOR_FG_RED.';'.Sgr::STYLE_BLINK.';'.Sgr::STYLE_BOLD.'m'.'te'.ControlFunction::C1_ESC.'['.Sgr::COLOR_BG_GREEN.'m'.'st'.ControlFunction::C1_ESC.'['.Sgr::STYLE_NONE.'m'
        );
    }
}

// EOF
