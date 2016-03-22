<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 22/03/16
 * Time: 10:46
 */

namespace MsiClient\Central\Commands\Properties;




class ClientPlanProperties extends ProductConfigurationProperties
{
    public $plan_id;
    public $client_id;
    public $configs = [];
    /**
     * @var PlanProperties
     */
    public $plan;


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

        return $this;
    }


}