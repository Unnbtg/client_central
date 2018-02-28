<?php
/**
 * Created by PhpStorm.
 * User: unm33
 * Date: 8/9/16
 * Time: 10:34 AM
 */

namespace MsiClient\CoreSciOnline\Commands;


use MsiClient\Client;

class InstallCommand extends CommandAbstract
{

    protected $url = '/install';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    public function install($params)
    {
        return $this->perform($params, Client::POST_REQUEST);
    }
    public function addDomain($domain, $instance)
    {
        return $this->perform(
            [
                'domain' => $domain,
                'instance' => $instance
            ], Client::POST_REQUEST, $this->getUrl().'/add-host');
    }

    public function birth($configs)
    {
        return $this->perform($configs, Client::POST_REQUEST, $this->getUrl().'/birth');
    }

}