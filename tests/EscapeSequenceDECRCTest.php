<?php

use Bramus\Ansi\Ansi;
use Bramus\Ansi\Writers\StreamWriter;
use Bramus\Ansi\ControlFunctions\Enums\C0;
use Bramus\Ansi\ControlSequences\EscapeSequences\DECRC as EscapeSequenceDECRC;
use Bramus\Ansi\ControlSequences\EscapeSequences\Enums\FinalByte;

class EscapeSequenceDECRCTest extends PHPUnit_Framework_TestCase
{
    public function testInstantiation()
    {
        $es = new EscapeSequenceDECRC();

        $this->assertInstanceOf('\Bramus\Ansi\ControlSequences\EscapeSequences\DECRC', $es);

        // Final byte must be DECRC
        $this->assertEquals(
            $es->getFinalByte(),
            FinalByte::DECRC
        );
    }

    public function testDECRCRaw()
    {
        $this->assertEquals(
            new EscapeSequenceDECRC(),
            C0::ESC . '[' . FinalByte::DECRC
        );
    }

    public function testAnsiDECRCShorthandsSingle()
    {
        $a = new Ansi(new \Bramus\Ansi\Writers\BufferWriter());

        $this->assertEquals(
            $a->restoreCursorPosition()->get(),
            new EscapeSequenceDECRC()
        );
    }

    public function testAnsiDECRCShorthandChained()
    {
        $a = new Ansi(new \Bramus\Ansi\Writers\BufferWriter());
        $es = new EscapeSequenceDECRC();

        $this->assertEquals(
            $a->restoreCursorPosition()->text('test')->get(),
            $es . 'test'
        );
    }

    public function testAnsiDECRCShorthandsChained()
    {
        $a = new Ansi(new \Bramus\Ansi\Writers\BufferWriter());

        $this->assertEquals(
            $a->restoreCursorPosition()->text('test')->restoreCursorPosition()->get(),
            (new EscapeSequenceDECRC()) . 'test' . (new EscapeSequenceDECRC())
        );
    }

    public function testAnsiDECRCPractical()
    {
        $this->markTestIncomplete("I was unable to make a working practical test of this");
    }
}

// EOF
