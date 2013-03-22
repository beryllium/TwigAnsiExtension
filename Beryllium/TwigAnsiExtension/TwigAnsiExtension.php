<?php

namespace Beryllium\TwigAnsiExtension;

use \Twig_Extension;
use \Twig_SimpleFilter;
use \SensioLabs\AnsiConverter\Theme\Theme;
use \SensioLabs\AnsiConverter\AnsiToHtmlConverter;

/**
 * Class TwigAnsiExtension
 *
 * Exposes the filter "ansi" and the function "get_ansi_css" to Twig
 *
 * @package Beryllium\TwigAnsiExtension
 */
class TwigAnsiExtension extends Twig_Extension
{
    /**
     * @var null|\SensioLabs\AnsiConverter\AnsiToHtmlConverter
     */
    public $ansi = null;

    /**
     * @var \SensioLabs\AnsiConverter\Theme\Theme
     */
    public $theme;

    /**
     * @param AnsiToHtmlConverter $ansi An instance of AnsiToHtmlConverter
     * @param Theme $theme [optional] An optional Theme for AnsiToHtmlConverter (used for retrieving CSS styles)
     */
    public function __construct(AnsiToHtmlConverter $ansi, Theme $theme = null)
    {
        $this->ansi = $ansi;
        $this->theme = $theme;
    }

    // --- Twig Methods ---
    public function getName()
    {
        return 'ansi';
    }

    public function getFilters()
    {
        return array(
            new Twig_SimpleFilter('ansi', array($this, 'ansiToHtml')),
        );
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('get_ansi_css', array($this, 'getStyles')),
        );
    }

    // --- The Fun Stuff ---

    /**
     * The "ansi" filter. Use it in your twig templates like so:
     *
     *   {{ my_ansi_value|ansi|raw }}
     *
     * @param string $input A string of ANSI text
     * @return string HTML representation of the ANSI text
     */
    public function ansiToHtml($input)
    {
        return $this->ansi->convert($input);
    }

    /**
     * The "get_ansi_css" function. Use it in your twig templates to output css. Example:
     *
     * <style type="text/css">
     *   {{ get_ansi_css()|raw }}
     * </style>
     *
     * @return string CSS declarations for the enabled ANSI theme
     */
    public function getStyles()
    {
        if (!is_null($this->theme)) {
            return $this->theme->asCss();
        }

        return '';
    }
}