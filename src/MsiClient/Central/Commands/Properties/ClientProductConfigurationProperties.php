<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 11/03/16
 * Time: 11:43
 */

namespace MsiClient\Central\Commands\Properties;


/***
 * Class ClientProductConfigurationProperties
 * @package MsiClient\Central\Commands\Properties
 * @property integer $client_product_id
 * @property integer $product_configuration_id
 * @property integer $user_id
 * @property mixed $value
 * @property ProductConfigurationProperties $product_configuration
 *
 */
class ClientProductConfigurationProperties extends PropertiesAbstract
{


    public static function factory($client_product_id, $product_configuration_id, $value) {
        $retorno = new ClientProductConfigurationProperties();
        $retorno->client_product_id = $client_product_id;
        $retorno->product_configuration_id = $product_configuration_id;
        $retorno->value = $value;

        return $retorno;
    }

    protected function fromJsonElement($elements)
    {
        parent::fromJsonElement($elements);

        if (isset($elements->product_configuration)) {
            $productConfiguration = new ProductConfigurationProperties();
            $this->product_configuration  = $productConfiguration->fromJsonElement($elements->product_configuration);
        }

        return $this;
    }
}