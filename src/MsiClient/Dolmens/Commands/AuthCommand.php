<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 9/29/16
 * Time: 3:09 PM
 */

namespace MsiClient\Dolmens\Commands;

use MsiClient\Client;

class AuthCommand extends Command
{
    protected $url = "/auth";

    public function __construct(Client $client)
    {
        $this->setClient($client);
    }

    public function getToken($id, $code)
    {
        return $this->perform(['id' => $id, 'code' => $code], Client::POST_REQUEST, $this->getUrl() . '/create-token');
    }

    public function authToken($token)
    {
        return $this->perform([], Client::GET_REQUEST, $this->getUrl() . '/auth-token/' . $token);
    }

    public function getUser($id)
    {
        return $this->perform([], Client::GET_REQUEST, $this->getUrl() . '/get-user/' . $id);
    }

    public function getByRememberToken($token)
    {
        return $this->perform(['token' => $token], Client::POST_REQUEST, $this->getUrl() . '/remember-token');
    }

    public function setRememberToken($id, $token)
    {
        return $this->perform(['id'=> $id, 'token' => $token], Client::POST_REQUEST, $this->getUrl() . '/update-remember-token');
    }

}