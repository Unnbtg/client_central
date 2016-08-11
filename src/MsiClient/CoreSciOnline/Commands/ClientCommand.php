<?php
/**
 * Created by PhpStorm.
 * User: unm33
 * Date: 8/9/16
 * Time: 5:10 PM
 */

namespace MsiClient\CoreSciOnline\Commands;


class ClientCommand extends CommandAbstract
{

    protected $url = '/clients';

    public function __construct(\MsiClient\Client $client)
    {
        $this->client = $client;
    }

    public function setConfig($account, $configuration, $value)
    {
        var_dump(['value' => $value], $this->getUrl()."/$account/configs/$configuration");
        $this->perform(['value' => $value], \MsiClient\Client::PUT_REQUEST, $this->getUrl()."/$account/configs/$configuration");
    }

}