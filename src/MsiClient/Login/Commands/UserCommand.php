<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 9/29/16
 * Time: 12:27 PM
 */

namespace MsiClient\Login\Commands;


use MsiClient\Client;

class UserCommand extends CommandAbstract
{
    protected $url = "/users";

    public function __construct(Client $client)
    {
        $this->setClient($client);
    }

    public function get($id)
    {
        return $this->perform([], Client::GET_REQUEST, $this->getUrl().'/'.$id);
    }

    public function update($id, $attributes)
    {
        return $this->perform($attributes, Client::PUT_REQUEST, $this->getUrl().'/'.$id);
    }

    public function store($attributes)
    {
        return $this->perform($attributes, Client::POST_REQUEST, $this->getUrl());
    }

    public function search($filters)
    {
        return $this->perform($filters, Client::GET_REQUEST, $this->getUrl());
    }
}