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

    public function getCongifs()
    {
        $retorno = [];
        foreach ($this->configurations as $configurationProperties) {
            $retorno[] = $configurationProperties->name;
        }

        return $retorno;
    }

    /**
     * @param $name
     * @return ProductConfigurationProperties
     */
    public function getConfig($name)
    {
        foreach ($this->configurations as $configuration) {
            if ($configuration->name == $name) {
                return $configuration;
            }
        }
    }

    protected function fromJsonElement($elements)
    {
        parent::fromJsonElement($elements);
        unset($this->configurations);
        $this->configurations = [];
        if (isset($elements->configurations)) {
            foreach ($elements->configurations as $value) {
                $configs = new ProductConfigurationProperties();
                $this->configurations[] = $configs->fromJsonElement($value);
            }
        }
        return $this;
    }

}