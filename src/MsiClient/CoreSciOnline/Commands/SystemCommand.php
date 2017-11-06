<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 11/1/17
 * Time: 8:33 AM
 */

namespace MsiClient\CoreSciOnline\Commands;


use MsiClient\Client;

class SystemCommand extends CommandAbstract
{


    protected $url = '/system';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function uninstall($instance)
    {
        return $this->perform(
            [
                'instance' => $instance
            ], Client::POST_REQUEST, $this->getUrl()."/{$instance}/uninstall"
        );
    }
}