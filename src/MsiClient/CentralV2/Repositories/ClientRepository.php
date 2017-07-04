<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 11/04/2017
 * Time: 16:43
 */

namespace MsiClient\CentralV2\Repositories;


use MsiClient\Client;

class ClientRepository extends RepositoryAbstract
{

    protected $url = "/clients";

    public function get($query) {
        return $this->perform([], Client::GET_REQUEST, $this->getUrl()."?{$query}");
    }

}