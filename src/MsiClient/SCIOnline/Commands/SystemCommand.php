<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 11/3/17
 * Time: 2:34 PM
 */

namespace MsiClient\SCIOnline\Commands;


class SystemCommand extends Command
{

    protected $url = '/system';

    public function __construct(\MsiClient\Client $client)
    {
        $this->setClient($client);
    }

    public function sleep($code, $key)
    {
        return $this->perform([], Client::POST_REQUEST, $this->getUrl() . '/sleeping-pills', ['X-Sci-Instance' => $code, "X-Root-Key" => $key]);
    }

}