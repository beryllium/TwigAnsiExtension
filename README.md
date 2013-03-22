# ANSI to HTML5 Converter Extension for Twig

Inspired by the sensiolabs/ansi-to-html release, I wanted to create a quick Twig extension for rendering ANSI as HTML inside Twig templates.

### Installation

Add the requirement to your composer.json (it should fetch ansi-to-html automatically):

    {
      "require": {
        "beryllium/twig-ansi-extension": "dev-master"
      }
    }

### Usage

Default usage:

    $twig->addExtension(new Beryllium\TwigAnsiExtension\TwigAnsiExtension($ansi));

Optional "themed" usage:

    $twig->addExtension(new Beryllium\TwigAnsiExtension\TwigAnsiExtension($ansi,$theme));

And now you can use it inside twig, like so:

    {{ 'my_ansi_string'|ansi_raw }}

If you opted to add the theme, you should be able to output the style CSS like so:

    {{ get_ansi_css()|raw }}

### Current Status

At the moment this is just a quick prototype, I haven't even tested the theme support. In my local environemnt, I'm using the "colordiff" system utility to generate sample ANSI output. Other examples of ANSI output include PHPUnit with colors enabled, and especially PHPUnit with NyanCat output enabled.
