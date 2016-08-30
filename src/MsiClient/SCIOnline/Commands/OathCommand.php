<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 8/19/16
 * Time: 2:06 PM
 */

namespace MsiClient\SCIOnline\Commands;


use MsiClient\Client;

class OathCommand extends Command
{

    protected $url = "/oauth";

    public function __construct(Client $client)
    {

        $this->setClient($client);
    }


    public function getAccesToken($sciInstance, $userName, $password, $clientId, $secret) {
        $toSend = [
            "grant_type" => "password",
            "username" => $userName,
            "password" => $password,
            "client_id" => $clientId ,
            "client_secret" => $secret
        ];

        $token = $this->perform($toSend, Client::POST_REQUEST, $this->getUrl().'/access_token', [
            "X-Sci-Instance" => $sciInstance
        ]);

        if (!is_object($token)){
            return false;
        }

        return $token->data->access_token;
    }


}
