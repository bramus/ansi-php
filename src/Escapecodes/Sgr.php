<?php
/**
 * Select Graphic Rendition Escape Code
 *
 * SGR is used to establish one or more graphic rendition aspects for
 * subsequent text. The established aspects remain in effect until the
 * next occurrence of SGR in the data stream, depending on the setting
 * of the GRAPHIC RENDITION COMBINATION MODE (GRCM). Each graphic
 * rendition aspect is specified by a parameter value
 *
 * @var string
 */
namespace Bramus\Ansi\Escapecodes;

class Sgr extends Base
{
    /**
     * Default rendition, cancels the effect of any preceding occurrence of SGR in the data stream
     * @type {String}
     */
    const STYLE_NONE = '0';

    /**
     * Bold: On ~or~ increased intensity
     * @type {String}
     */
    const STYLE_INTENSITY_BRIGHT = '1';

    /**
     * Bold: On ~or~ increased intensity
     * @type {String}
     */
    const STYLE_BOLD = '1';

    /**
     * Faint, decreased intensity
     * @note Not widely supported
     * @type {String}
     */
    const STYLE_INTENSITY_FAINT = '2';

    /**
     * Italic: On
     * @note Not widely supported
     * @type {String}
     */
    const STYLE_ITALIC = '3';

    /**
     * Underline: On
     * @type {String}
     */
    const STYLE_UNDERLINE = '4';

    /**
     * Blink: On
     * @type {String}
     */
    const STYLE_BLINK = '5';

    /**
     * Blink (Rapid): On
     * @note Not widely supported
     * @type {String}
     */
    const STYLE_BLINK_RAPID = '6';

    /**
     * Inverse or reverse colors (viz. swap foreground and background)
     * @type {String}
     */
    const STYLE_NEGATIVE = '7';

    /**
     * Conceal (Hide) text
     * @note Not widely supported
     * @type {String}
     */
    const STYLE_CONCEAL = '8';

    /**
     * Cross-out / strikethrough text
     * @note Not widely supported
     * @type {String}
     */
    const STYLE_STRIKETHROUGH = '9';

    /**
     * Bold: Off ~or~ increased intensity
     * @type {String}
     */
    const STYLE_INTENSITY_NORMAL = '22';

    /**
     * Bold: Off ~or~ increased intensity
     * @type {String}
     */
    const STYLE_BOLD_OFF = '22';

    /**
     * Italic: Off
     * @note Not widely supported
     * @type {String}
     */
    const STYLE_ITALIC_OFF = '23';

    /**
     * Underline: Off
     * @type {String}
     */
    const STYLE_UNDERLINE_OFF = '24';

    /**
     * Blink: Off
     * @type {String}
     */
    const STYLE_BLINK_OFF = '5';

    const STYLE_POSITIVE = '27';

    const STYLE_REVEAL = '28';

    const STYLE_STRIKETHROUGH_OFF = '29'; // Not widely supported


    const COLOR_FG_BLACK = '30';
    const COLOR_FG_RED = '31';
    const COLOR_FG_GREEN = '32';
    const COLOR_FG_YELLOW = '33';
    const COLOR_FG_BLUE = '34';
    const COLOR_FG_PURPLE = '35';
    const COLOR_FG_CYAN = '36';
    const COLOR_FG_WHITE = '37';
    const COLOR_FG_RESET = '39';

    const COLOR_BG_BLACK = '40';
    const COLOR_BG_RED = '41';
    const COLOR_BG_GREEN = '42';
    const COLOR_BG_YELLOW = '43';
    const COLOR_BG_BLUE = '44';
    const COLOR_BG_PURPLE = '45';
    const COLOR_BG_CYAN = '46';
    const COLOR_BG_WHITE = '47';
    const COLOR_BG_RESET = '49';

    const STYLE_FRAMED = '51';
    const STYLE_ENCIRCLED = '52';
    const STYLE_OVERLINED = '53';
    const STYLE_FRAMED_ENCIRCLED_OFF = '54';
    const STYLE_OVERLINED_OFF = '55';

    const COLOR_FG_BLACK_BRIGHT = '90';
    const COLOR_FG_RED_BRIGHT = '91';
    const COLOR_FG_GREEN_BRIGHT = '92';
    const COLOR_FG_YELLOW_BRIGHT = '93';
    const COLOR_FG_BLUE_BRIGHT = '94';
    const COLOR_FG_PURPLE_BRIGHT = '95';
    const COLOR_FG_CYAN_BRIGHT = '96';
    const COLOR_FG_WHITE_BRIGHT = '97';
    const COLOR_FG_RESET_BRIGHT = '99';

    const COLOR_BG_BLACK_BRIGHT = '100';
    const COLOR_BG_RED_BRIGHT = '101';
    const COLOR_BG_GREEN_BRIGHT = '102';
    const COLOR_BG_YELLOW_BRIGHT = '103';
    const COLOR_BG_BLUE_BRIGHT = '104';
    const COLOR_BG_PURPLE_BRIGHT = '105';
    const COLOR_BG_CYAN_BRIGHT = '106';
    const COLOR_BG_WHITE_BRIGHT = '107';
    const COLOR_BG_RESET_BRIGHT = '109';

    /**
     * Select Graphic Rendition
     * @param array $params Parameter byte to the SGR Escape Code
     */
    public function __construct($params = null)
    {
        // Make sure we have params set
        if (!$params) {
            $params = array(self::STYLE_NONE);
        }

        // Call Parent Constructor
        parent::__construct($params, array(), self::FB_SGR);
    }

    /**
     * Add a Intermediate Byte
     * @param  string $intermediateByte The byte to add
     * @return Base   self, for chaining
     */
    public function addIntermediateByte($intermediateByte)
    {
        throw new \Exception('SGR Escape Codes have no intermediate bytes');
    }

    /**
     * Set the Intermediate Byte
     * @param  array $parameterByte The byte to add
     * @return Base  self, for chaining
     */
    public function setIntermediateByte($intermediateByte)
    {
        throw new \Exception('SGR Escape Codes have no intermediate bytes');
    }

    /**
     * Add a Parameter Byte
     * @param  string $parameterByte The byte to add
     * @return Base   self, for chaining
     */
    public function addParameterByte($parameterByte)
    {
        // @TODO: Check Validity
        return parent::addParameterByte($parameterByte);
    }

    /**
     * Build and return the ANSI Code
     * @return string The ANSI Code
     */
    public function get()
    {
        // Sort parameterbytes
        // sort($this->parameterByte);

        // Call Parent
        return parent::get();
    }
}

// EOF
