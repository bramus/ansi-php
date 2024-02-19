<?php

use \Bramus\Ansi\Ansi;
use \Bramus\Ansi\Writers\StreamWriter;
use \Bramus\Ansi\ControlFunctions\Enums\C0;
use \Bramus\Ansi\ControlSequences\EscapeSequences\DECSC as EscapeSequenceDECSC;
use \Bramus\Ansi\ControlSequences\EscapeSequences\Enums\FinalByte;

class EscapeSequenceDECSCTest extends PHPUnit_Framework_TestCase
{

    public function testInstantiation()
    {
        $es = new EscapeSequenceDECSC();

        $this->assertInstanceOf('\Bramus\Ansi\ControlSequences\EscapeSequences\DECSC', $es);

        // Final byte must be DECSC
        $this->assertEquals(
            $es->getFinalByte(),
            FinalByte::DECSC
        );
    }

    public function testDECSCRaw()
    {
        $this->assertEquals(
            new EscapeSequenceDECSC(),
            C0::ESC.'['.FinalByte::DECSC
        );
    }

    public function testAnsiDECSCShorthandsSingle()
    {
        $a = new Ansi(new \Bramus\Ansi\Writers\BufferWriter());

        $this->assertEquals(
            $a->saveCursorPosition()->get(),
            new EscapeSequenceDECSC()
        );
    }

    public function testAnsiDECSCShorthandChained()
    {
        $a = new Ansi(new \Bramus\Ansi\Writers\BufferWriter());
        $es = new EscapeSequenceDECSC();

        $this->assertEquals(
            $a->saveCursorPosition()->text('test')->get(),
            $es.'test'
        );
    }

    public function testAnsiDECSCShorthandsChained()
    {

        $a = new Ansi(new \Bramus\Ansi\Writers\BufferWriter());

        $this->assertEquals(
            $a->saveCursorPosition()->text('test')->saveCursorPosition()->get(),
            (new EscapeSequenceDECSC()).'test'.(new EscapeSequenceDECSC())
        );
    }

    public function testAnsiDECSCPractical()
    {
        $this->fail("I was unable to make a working practical test of this, and could not figure out why. If you can I'd be grateful :)");
    }
}

// EOF
