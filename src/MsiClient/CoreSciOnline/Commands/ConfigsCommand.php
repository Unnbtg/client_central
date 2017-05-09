<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 09/05/2017
 * Time: 10:00
 */

namespace MsiClient\CoreSciOnline\Commands;


use MsiClient\Client;

class ConfigsCommand extends CommandAbstract
{

    protected $url = '/configs';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    public function setConfig($configs) {
        return $this->perform($configs, Client::POST_REQUEST, $this->getUrl());
    }
}