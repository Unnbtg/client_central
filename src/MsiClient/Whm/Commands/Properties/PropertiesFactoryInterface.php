<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 02/03/16
 * Time: 17:48
 */

namespace MsiClient\Whm\Commands\Properties;


interface PropertiesFactoryInterface
{

    public static function create($array);

}