<?php
    /**
     * Created by PhpStorm.
     * User: unm
     * Date: 7/24/16
     * Time: 12:33 PM
     */

    namespace MsiClient\Central\Commands;

    use MsiClient\Central\Commands\Properties\PlanProperties;

    class PlanCommand extends Command
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

                $retorno = $this->perform([], \MsiClient\Client::GET_REQUEST, $this->getUrl() . '/' . $id);

                $plan = new PlanProperties();

                return $plan->fromStdClass($retorno);
            } catch (\Exception $e) {
                throw  $e;
            }
        }

        public function getAvaliablePlans($client_id)
        {
            try {
                return $this->perform([], \MsiClient\Client::GET_REQUEST, $this->getUrl()."/installable/{$client_id}");
            } catch (\Exception $e) {
                throw  $e;
            }
        }

    }