<?php

use \Bramus\Ansi\ControlFunction;
use \Bramus\Ansi\Escapecodes\Base;
use \Bramus\Ansi\Escapecodes\SGR;
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

    public function testSGR()
    {
        $test = $this->helper->sgr(array(SGR::COLOR_FG_RED, SGR::STYLE_BLINK, SGR::STYLE_BOLD))->text('te')->sgr(array(SGR::COLOR_BG_GREEN))->text('st')->sgr()->get();

        $this->assertEquals(
            $test,
            ControlFunction::C1_ESC.'['.SGR::COLOR_FG_RED.';'.SGR::STYLE_BLINK.';'.SGR::STYLE_BOLD.Base::FB_SGR.'te'.ControlFunction::C1_ESC.'['.SGR::COLOR_BG_GREEN.Base::FB_SGR.'st'.ControlFunction::C1_ESC.'['.SGR::STYLE_NONE.Base::FB_SGR
        );
    }

    public function testSGRShorthands()
    {
        $test = $this->helper->bold()->color(SGR::COLOR_FG_RED)->underline()->blink()->get() . 'test' . $this->helper->reset()->get();

        $this->assertEquals(
            $test,
            ControlFunction::C1_ESC.'['.SGR::STYLE_BOLD.Base::FB_SGR.ControlFunction::C1_ESC.'['.SGR::COLOR_FG_RED.Base::FB_SGR.ControlFunction::C1_ESC.'['.SGR::STYLE_UNDERLINE.Base::FB_SGR.ControlFunction::C1_ESC.'['.SGR::STYLE_BLINK.Base::FB_SGR.'test'.ControlFunction::C1_ESC.'['.SGR::STYLE_NONE.Base::FB_SGR
        );
    }
}

// EOF
