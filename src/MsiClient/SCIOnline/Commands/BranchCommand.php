<?php
/**
 * Created by PhpStorm.
 * User: unm33
 * Date: 8/10/16
 * Time: 6:55 PM
 */

namespace MsiClient\SCIOnline\Commands;


use MsiClient\Client;

class BranchCommand extends Command
{

    protected $url = "/branches";

    public function __construct(Client $client)
    {
        $this->setClient($client);
    }


    public function store($branch)
    {
        return $this->perform($branch, Client::POST_REQUEST);
    }

}