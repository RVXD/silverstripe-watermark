<?php
use SilverStripe\View\Parsers\ShortcodeParser;
use Gurucomkz\Watermark\Shortcode;
ShortcodeParser::get('default')->register('watermark', [Shortcode::class, 'Watermark']);

