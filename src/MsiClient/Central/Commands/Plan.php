<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 21/03/16
 * Time: 14:53
 */

namespace MsiClient\Central\Commands;


use MsiClient\Central\Commands\Properties\PlanProperties;

class Plan extends Command
{

    public $url = '/plan';


    public function getPlans($page = null)
    {
        try {
            return $this->perform(['page' => $page], \MsiClient\Client::GET_REQUEST, $this->getUrl());
        } catch (\Exception $e) {
            throw  $e;
        }
    }

    public function getPlan($id)
    {
        try {

            $retorno = $this->perform([], \MsiClient\Client::GET_REQUEST, $this->getUrl().'/'. $id);

            $plan = new PlanProperties();
            return $plan->fromStdClass($retorno);
        } catch (\Exception $e) {
            throw  $e;
        }
    }

}