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
 * @property ClientProductProperties[] $product_configurations
 */
class ClientProductProperties extends PropertiesAbstract
{
    protected function fromJsonElement($elements)
    {

        parent::fromJsonElement($elements);

        $product = new ProductProperties();

        $this->product = $product->fromJsonElement($elements->product);

        $cConfg = new ClientProductConfigurationProperties();


        unset($this->client_configuration);
        foreach($elements->client_configuration as $value ) {

            $this->product_configurations[] = $cConfg->fromJsonElement($value);
        }



        return $this;

    }


}