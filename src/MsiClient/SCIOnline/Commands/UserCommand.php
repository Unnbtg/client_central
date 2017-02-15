<?php
/**
 * Created by PhpStorm.
 * User: unm33
 * Date: 8/10/16
 * Time: 6:14 PM
 */

namespace MsiClient\SCIOnline\Commands;


class UserCommand extends Command
{

    protected $url ='/users';

    public function __construct(\MsiClient\Client $client)
    {
        $this->setClient($client);
    }


    public function store($client)
    {
        return $this->perform($client, \MsiClient\Client::POST_REQUEST);
    }



    public function recovery($email, $redirect, $sciInstance)
    {
        $toSend = [
            "email" => $email,
            'redirect_to' => $redirect
        ];

        $token = $this->perform($toSend, \MsiClient\Client::POST_REQUEST, $this->getUrl().'/reset-password', [
            "X-Sci-Instance" => $sciInstance
        ]);

        if (!is_object($token)){
            return false;
        }

        return true;
    }

    public function sendActivation($email, $redirect, $sciInstance)
    {
        $toSend = [
            "email" => $email,
            'redirect_to' => $redirect
        ];

        $token = $this->perform($toSend, \MsiClient\Client::POST_REQUEST, $this->getUrl().'/send-activation', [
            "X-Sci-Instance" => $sciInstance
        ]);

        if (!is_object($token)){
            return false;
        }

        return true;
    }
}