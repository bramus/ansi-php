<?php

use \Bramus\Ansi\Ansi;
use \Bramus\Ansi\ControlFunctions\Enums\C0;
use \Bramus\Ansi\ControlSequences\EscapeSequences\Enums\FinalByte;
use \Bramus\Ansi\ControlSequences\EscapeSequences\Enums\SGR;

class ControlSequenceTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->helper = new Ansi();
    }

    protected function tearDown()
    {
        // ...
    }

    public function testInstantiation()
    {
        $this->assertInstanceOf('\Bramus\Ansi\Ansi', $this->helper);
    }

    public function testSGR()
    {
        $test = $this->helper->sgr(SGR::COLOR_FG_RED)->get();

        $this->assertEquals(
            $test,
            C0::ESC.'['.SGR::COLOR_FG_RED.FinalByte::SGR
        );

        $test2 = $this->helper->sgr()->get();

        $this->assertEquals(
            $test2,
            C0::ESC.'['.SGR::STYLE_NONE.FinalByte::SGR
        );
    }

    public function testSGRChained()
    {
        $test = $this->helper->sgr(array(SGR::COLOR_FG_RED, SGR::STYLE_BLINK, SGR::STYLE_BOLD))->text('te')->sgr(array(SGR::COLOR_BG_GREEN))->text('st')->sgr()->get();

        $this->assertEquals(
            $test,
            C0::ESC.'['.SGR::COLOR_FG_RED.';'.SGR::STYLE_BLINK.';'.SGR::STYLE_BOLD.FinalByte::SGR.'te'.C0::ESC.'['.SGR::COLOR_BG_GREEN.FinalByte::SGR.'st'.C0::ESC.'['.SGR::STYLE_NONE.FinalByte::SGR
        );
    }

    public function testSGRShorthands()
    {
        $test = $this->helper->bold()->color(SGR::COLOR_FG_RED)->underline()->blink()->get().'test'.$this->helper->reset()->get();

        $this->assertEquals(
            $test,
            C0::ESC.'['.SGR::STYLE_BOLD.FinalByte::SGR.C0::ESC.'['.SGR::COLOR_FG_RED.FinalByte::SGR.C0::ESC.'['.SGR::STYLE_UNDERLINE.FinalByte::SGR.C0::ESC.'['.SGR::STYLE_BLINK.FinalByte::SGR.'test'.C0::ESC.'['.SGR::STYLE_NONE.FinalByte::SGR
        );
    }
}

// EOF
