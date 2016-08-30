<?php
/**
 * Created by PhpStorm.
 * User: unm33
 * Date: 8/10/16
 * Time: 6:14 PM
 */

namespace MsiClient\SCIOnline\Commands;


use MsiClient\Client;

class UserCommand extends Command
{

    protected $url ='/users';

    public function __construct(\MsiClient\Client $client)
    {
        $this->setClient($client);
    }


    public function store($client)
    {
        return $this->perform($client, Client::POST_REQUEST);
    }



    public function recovery($email, $sciInstance)
    {
        $toSend = [
            "email" => $email,
        ];

        $token = $this->perform($toSend, Client::POST_REQUEST, $this->getUrl().'/reset-password ', [
            "X-Sci-Instance" => $sciInstance
        ]);

        if (!is_object($token)){
            return false;
        }

        return true;
    }
}