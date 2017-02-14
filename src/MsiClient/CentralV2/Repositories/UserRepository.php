<?php
/**
 * Created by PhpStorm.
 * User: unamed
 * Date: 09/02/17
 * Time: 12:25
 */

namespace MsiClient\CentralV2\Repositories;


use MsiClient\Client;

class UserRepository extends RepositoryAbstract
{

    protected $url = "/users";

    public function authenticate($email, $password)
    {
        $toSend = [
            'email' => $email,
            'password' => $password
        ];
        return $this->perform($toSend, Client::POST_REQUEST, $this->getUrl().'/authenticate');
    }

    public function find($identifier, $with = [])
    {
        return $this->perform(['with' => $with], Client::GET_REQUEST, $this->getUrl().'/'. $identifier);
    }

    public function setRememberToken($identifier, $token)
    {
        return $this->perform(['id' => $identifier, 'remember_token' => $token], Client::POST_REQUEST, $this->getUrl().'/set-token');
    }

    public function getByToken($identifier, $token)
    {
        return $this->perform(['id' => $identifier, 'remember_token' => $token], Client::POST_REQUEST, $this->getUrl().'/get-token');
    }
}