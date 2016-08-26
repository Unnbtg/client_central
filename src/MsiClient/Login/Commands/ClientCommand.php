<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 25/08/16
 * Time: 11:50
 */

namespace MsiClient\Login\Commands;


use MsiClient\Client;

class ClientCommand extends CommandAbstract
{
    protected $url = "clients";

    public function __construct(Client $client)
    {
        $this->setClient($client);
    }


    public function store($code, $instance,  $key)
    {
        return $this->perform(['code' => $code, 'instance'=> $instance], Client::POST_REQUEST, $this->getUrl(),
            ['Authorization' => "Bearer " . $key]);
    }
}