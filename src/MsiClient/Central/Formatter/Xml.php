<?php

namespace MsiClient\Central\Formatter;

class Xml extends Formatter
{
    protected $mimeType = 'application/xml';
    /**
     * @inheritDoc
     */
    public function decode($value)
    {
        return simplexml_load_string($value);
    }

    public function encode($value)
    {
        return '';
    }
}
