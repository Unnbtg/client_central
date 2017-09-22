<?php
/**
 * Created by PhpStorm.
 * User: unm33
 * Date: 8/10/16
 * Time: 5:35 PM
 */

namespace MsiClient\SCIOnline\Commands;


use MsiClient\Client;

class InstallCommand extends Command
{

    protected $url = '/system';

    public function __construct(\MsiClient\Client $client)
    {
        $this->setClient($client);
    }


    public function install($code, $conn, $masterKey, $overrides)
    {
        $config = [
            'code'     => $code,
            "database" => $conn,
            'rootkey'  => $masterKey,
            'overrides' => $overrides
        ];

        return $this->perform($config, \MsiClient\Client::POST_REQUEST, $this->getUrl() . '/life', ["X-Root-Key" => $masterKey]);
    }


    public function release($code, $masterKey)
    {
        return $this->perform(['rootkey' => $masterKey], Client::POST_REQUEST, $this->getUrl() . '/release', ['X-Sci-Instance' => $code, "X-Root-Key" => $masterKey]);
    }

    public function notifyEnd()
    {
        $this->perform([], Client::POST_REQUEST, $this->getUrl() . '/birth');
    }

    public function getUserToken($code, $masterKey)
    {
        return $this->perform([], Client::POST_REQUEST, $this->getUrl().'/users/1/token', ['X-Sci-Instance' => $code, "X-Root-Key" => $masterKey]);
    }

    public function addDomainAlias($identifier, $domain, $masterKey)
    {
        return $this->perform(
            ['domain_alias' => $domain],
            Client::PUT_REQUEST,
            $this->getUrl()."/websites/{$identifier}/domain-alias",
            ['X-Root-Key' => $masterKey]
        );
    }
}