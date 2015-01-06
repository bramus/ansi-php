<?php

use \Bramus\Ansi\Ansi;
use \Bramus\Ansi\ControlFunctions\Enums\C0;

class ControlFunctionTest extends PHPUnit_Framework_TestCase
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

    public function testAnsiChaining()
    {
        $test = $this->helper->bell()->text('bar')->tab()->text('foo')->bell()->get();

        $this->assertEquals(
            $test,
            C0::BELL.'bar'.C0::TAB.'foo'.C0::BELL
        );
    }
}

// EOF
