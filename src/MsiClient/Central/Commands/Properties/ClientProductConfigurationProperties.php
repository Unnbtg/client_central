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
 * @property integer $product_configuration_id
 * @property integer $user_id
 * @property ProductConfigurationProperties $productConfiguration
 *
 */
class ClientProductConfigurationProperties extends PropertiesAbstract
{
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