<?php
/**
 * Created by PhpStorm.
 * User: unm33
 * Date: 8/8/16
 * Time: 3:24 PM
 */

namespace MsiClient\Central\Commands;


class InstallCommand extends Command
{

    protected $url = '/install';

    public function __construct(\MsiClient\Client $client)
    {
        $this->setClient($client);
    }

    public function install($clientProductId) {
        $this->perform([], \MsiClient\Client::POST_REQUEST, $this->getUrl().'/'.$clientProductId);
    }

}