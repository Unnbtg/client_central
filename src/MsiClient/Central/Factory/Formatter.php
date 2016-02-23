<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 16/02/16
 * Time: 17:41
 */

namespace MsiClient\Central\Factory;


use MsiClient\Central\Formatter\IFormatter;
use MsiClient\Central\Formatter\Json;

class Formatter
{



    private static $fomatters = [
      'application/json' => Json::class
    ];

    /***
     * Returns a formatter accordingly with the content type passed.
     * If no formatter is available will return null instead.
     *
     * @param string $name ContentType that you want a formatter for.
     * @return IFormatter
     */
    public static function create($name) {

        if (!isset(self::$fomatters[$name])) {
            return null;
        }

        return new self::$fomatters[$name]();
    }

}