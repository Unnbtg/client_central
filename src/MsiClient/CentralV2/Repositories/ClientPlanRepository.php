<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 11/04/2017
 * Time: 16:43
 */

namespace MsiClient\CentralV2\Repositories;


use MsiClient\Client;

class ClientPlanRepository extends RepositoryAbstract
{

    protected $url = "/client-plans";

    public function movePossibilities($identify) {
        return $this->perform([], Client::GET_REQUEST, $this->getUrl()."/{$identify}/move-possibilities");
    }

    public function changePlan($clientPlanId, $planId) {
        return $this->perform(['plan_id' => $planId], Client::GET_REQUEST, $this->getUrl()."/{$clientPlanId}/change-plan");
    }

}