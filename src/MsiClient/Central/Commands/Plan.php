<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 21/03/16
 * Time: 14:53
 */

namespace MsiClient\Central\Commands;


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
            return $this->perform([], \MsiClient\Client::GET_REQUEST, $this->getUrl().'/'. $id);
        } catch (\Exception $e) {
            throw  $e;
        }
    }

}