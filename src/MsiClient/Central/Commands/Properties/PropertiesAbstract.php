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
    public function toArray()
    {
        $retorno = [];
        foreach ($this as $key => $property) {
            $retorno[$key] = $property;
        }

        return $retorno;
    }

    public function fromStdClass($std)
    {
        return $this->fromJsonElement($std);
    }

    protected function fromJsonElement($elements)
    {
        foreach ($elements as $name => $value) {
            if (in_array($name, ['created_at', 'updated_at', 'deleted_at']) && is_string($value)) {
                $this->$name = new \DateTime($value);
                continue;
            }
            $this->$name = $value;
        }

        return $this;
    }


}