<?php
/**
 * Created by PhpStorm.
 * User: Marco
 * Date: 26/02/2016
 * Time: 10:20
 */

namespace MsiClient\Central\Commands\Properties;


abstract class PropertiesAbstract
{

    public function toArray() {
        $retorno = [];
        foreach ($this as $key => $property) {
            $retorno[$key] = $property;
        }

        return $retorno;
    }

}