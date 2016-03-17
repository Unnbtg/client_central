<?php
/**
 * Created by PhpStorm.
 * User: Marco
 * Date: 26/02/2016
 * Time: 10:20
 */

namespace MsiClient\Whm\Commands\Properties;

abstract class PropertiesAbstract
{
    public function toArray($ignoreNull = false) {
        $retorno = [];
        foreach ($this as $key => $property) {

            if ($ignoreNull && is_null($property)) {
                continue;
            }

            $retorno[$key] = $property;
        }

        return $retorno;
    }

    protected static function factory($array, $name) {

        $instance = new $name;

        foreach($array as $key => $value) {
            $instance->$key = $value;
        }

        return $instance;
    }
}