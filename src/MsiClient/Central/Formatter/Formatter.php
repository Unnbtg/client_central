<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 16/02/16
 * Time: 17:46
 */

namespace MsiClient\Central\Formatter;


abstract class Formatter implements  IFormatter
{

    protected $mimeType = '';

    /**
     * @inheritDoc
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }


}