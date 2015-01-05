<?php

use \Bramus\Ansi\ControlFunction;
use \Bramus\Ansi\Helper;

class ControlFunctionTest extends PHPUnit_Framework_TestCase
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

    public function testHelperChaining()
    {
        $test = $this->helper->bell()->text('bar')->tab()->text('foo')->bell()->get();

        $this->assertEquals(
            $test,
            ControlFunction::C1_BELL.'bar'.ControlFunction::C1_TAB.'foo'.ControlFunction::C1_BELL
        );
    }
}

// EOF
