<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 22/03/16
 * Time: 10:46
 */

namespace MsiClient\Central\Commands\Properties;


/**
 * Class ClientPlanProperties
 * @package MsiClient\Central\Commands\Properties
 *
 * @property integer $plan_id
 * @property integer $client_id
 * @property PlanProperties $plan
 * @property ClientProductProperties[] $client_products
 */
class ClientPlanProperties extends ProductConfigurationProperties
{

    public function addConfig($productConfigurationId, $value, $productId) {
        $this->configs[] = [
            "product_configuration_id" => $productConfigurationId,
            "value" => $value,
            "product_id" => $productId
        ];
    }

    protected function fromJsonElement($elements)
    {
        parent::fromJsonElement($elements);

        if (isset($elements->plan)) {

            unset($this->plan);

            $plan = new PlanProperties();
            $plan->fromJsonElement($elements->plan);
            $this->plan = $plan;
        }

        if (isset($elements->client)) {
            $client = new ClientProperties();
            $client->fromJsonElement($elements->client);
            $this->client = $client;
        }

        if (isset($elements->client_products)) {
            unset($this->client_products);

            foreach($elements->client_products as $client_product){
                $cProducts = new ClientProductProperties();
                $cProducts->fromJsonElement($client_product);
                $this->client_products[] = $cProducts;
            }
        }

        return $this;
    }


}