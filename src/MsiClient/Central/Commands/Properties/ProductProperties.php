<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 11/03/16
 * Time: 11:25
 */

namespace MsiClient\Central\Commands\Properties;

/**
 * Class ProductProperties
 * @package MsiClient\Central\Commands\Properties
 *
 *
 * @property integer $id
 * @property string $name
 * @property ProductConfigurationProperties[] $configurations
 */
class ProductProperties extends PropertiesAbstract
{

    public function getCongifs() {
        $retorno = [];
        foreach( $this->configurations as $configurationProperties) {
            $retorno[] = $configurationProperties->name;
        }

        return $retorno;
    }

    public function getConfigValue($name) {
        foreach($this->configurations as $configuration) {
            if ($configuration->name == $name) {
                return $configuration->value;
            }
        }
    }

    protected function fromJsonElement($elements)
    {
        parent::fromJsonElement($elements);

        $configs = new ProductConfigurationProperties();

        unset($this->configurations);

        foreach ($elements->configurations as $value) {
            $this->configurations[] = $configs->fromJsonElement($value);
        }

        return $this;
    }

}