<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 8/16/16
 * Time: 10:49 AM
 */

namespace MsiClient\SCIOnline\Commands;


use MsiClient\Client;

class WebsiteCommand extends Command
{

    protected $url = '/websites';

    public function __construct(Client $client)
    {
        $this->setClient($client);
    }


    public function store($account, $name, $domain, $settings)
    {
        return $this->perform([
            'uid' => $account,
            'name' => $name,
            'domain' => $domain,
            'settings' => $settings
        ], Client::POST_REQUEST);
    }

}