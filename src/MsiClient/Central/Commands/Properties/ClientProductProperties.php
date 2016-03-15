<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 11/03/16
 * Time: 11:33
 */

namespace MsiClient\Central\Commands\Properties;


/**
 * Class ClientProductProperties
 * @package MsiClient\Central\Commands\Properties
 *
 * @property integer $id
 * @property integer $client_id
 * @property integer $user_id
 * @property integer $client_plan_id
 * @property ProductProperties $product
 * @property ClientProductConfigurationProperties[] $product_configurations
 */
class ClientProductProperties extends PropertiesAbstract
{

    public function getConfigs() {
        $retorno = [];

        foreach($this->product->configurations as $config) {
            $retorno[] = $config->name;
        }

        return $retorno;
    }

    public function getConfigValue($name) {

        $config = $this->getConfig($name);
        return $config->value;
    }

    /**
     * @param $name
     * @return ClientProductConfigurationProperties
     */
    public function getConfig($name) {
        foreach($this->product_configurations as $config) {
            if ($config->product_configuration->name == $name) {
                return $config;
            }
        }
    }

    protected function fromJsonElement($elements)
    {
        parent::fromJsonElement($elements);

        $product = new ProductProperties();

        $this->product = $product->fromJsonElement($elements->product);

        unset($this->client_configuration);

        foreach($elements->client_configuration as $value ) {
            $cConfg = new ClientProductConfigurationProperties();
            $this->product_configurations[] = $cConfg->fromJsonElement($value);
        }

        return $this;

    }


}