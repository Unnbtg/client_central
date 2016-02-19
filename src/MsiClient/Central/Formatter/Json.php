<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 16/02/16
 * Time: 17:41
 */

namespace MsiClient\Central\Formatter;


class Json extends Formatter
{


    protected $mimeType = 'application/json';


    /**
     * @inheritDoc
     */
    public function decode($value)
    {
        return json_decode($value);
    }

    /**
     * @inheritDoc
     */
    public function encode($value)
    {
        return json_encode($value);
    }


}