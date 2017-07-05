<?php
/**
 * Created by PhpStorm.
 * User: unamed
 * Date: 22/02/17
 * Time: 18:33
 */

namespace MsiClient\CentralV2\Repositories;


use MsiClient\Client;

class ClientProductRepository extends RepositoryAbstract
{

    protected $url = '/client-products';

    public function addDomain($identify, $attributes)
    {
        return $this->perform($attributes, Client::POST_REQUEST, $this->getUrl()."/{$identify}/config/add-domain");
    }

    public function addMxEntry($identify, $attributes)
    {
        return $this->perform($attributes, Client::POST_REQUEST, $this->getUrl()."/{$identify}/config/add-mx-entry");
    }

    public function changeModel($identify, $newModel) {
        return $this->perform(["new_model" => $newModel], Client::POST_REQUEST, $this->getUrl()."/{$identify}/configs/change-model");
    }

    public function getConfigs($identify, $params)
    {
        return $this->perform($params, Client::GET_REQUEST, $this->getUrl()."/{$identify}/configs");
    }

    public function removeMxZone($identify, $domainId, $attributes)
    {
        return $this->perform($attributes, Client::POST_REQUEST, $this->getUrl()."/{$identify}/config/remove-mx-zone/{$domainId}");
    }

    public function sciOnlineLoginLink($identify)
    {
        return $this->perform([], Client::GET_REQUEST, $this->getUrl()."/{$identify}/sci-online/login-link");
    }
}