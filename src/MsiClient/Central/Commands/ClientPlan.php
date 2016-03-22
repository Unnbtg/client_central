<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 22/03/16
 * Time: 10:48
 */

namespace MsiClient\Central\Commands;


use MsiClient\Central\Commands\Properties\ClientPlanProperties;
use MsiClient\Central\Factory\Formatter;

class ClientPlan extends Command
{

    public $url = "/client-plan/";

    public function show(ClientPlanProperties $planProperties)
    {
        try {
            $formatter = Formatter::create(\MsiClient\Client::Formart_Request);
            $result = $this->perform($formatter->encode(['client_plan' => $planProperties->toArray()]), \MsiClient\Client::GET_REQUEST, $this->getUrl())->data;

            $plan = new ClientPlanProperties();
            return $plan->fromStdClass($result);
        } catch (\Exception $e) {
            throw  $e;
        }
    }

    public function find($id = null) {

        try {

            if (is_null($id)) {
                $result = $this->perform([], \MsiClient\Client::GET_REQUEST, $this->getUrl())->data;
            } else {
                $result = $this->perform([], \MsiClient\Client::GET_REQUEST, $this->getUrl() . $id)->data;
            }

            $plan = new ClientPlanProperties();


            return $plan->fromStdClass($result);
        } catch (\Exception $e) {
            throw  $e;
        }
    }
}