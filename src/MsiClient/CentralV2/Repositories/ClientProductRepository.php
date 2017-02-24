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

    protected $url = '/client-product';

    public function addDomain($identify, $attributes)
    {
        return $this->perform($attributes, Client::POST_REQUEST, $this->getUrl()."/{$identify}/config/add-domain");
    }

    public function addMxEntry($identify, $attributes)
    {
        return $this->perform($attributes, Client::POST_REQUEST, $this->getUrl()."/{$identify}/config/add-mx-entry");
    }
}