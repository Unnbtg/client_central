<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 12/02/16
 * Time: 16:42
 */

namespace MsiClient\Central\Commands;


use MsiClient\Central\Exception\General;
use MsiClient\Client;

abstract class Command
{

    /***
     * @var Client $client
     */
    public $client;

    protected $url;


    public function getUrl()
    {
        return $this->client->getHost().  $this->url;
    }


    /**
     * @param Client $client
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Perform what the command is intended to do.
     * @param mixed $params  An array with the values the command need to do the action.
     * @param string $typeRequest Type of the request
     * @param null $url
     * @return array|\Guzzle\Http\EntityBodyInterface|string
     * @throws General
     */
    protected function perform($params, $typeRequest, $url = null)
    {
        if (is_null($url)) {
            $url = $this->getUrl();
        }

        if (empty($this->client)) {
            throw new General('You must provide a MSiClient\Central\Client in order to perform any requisition to the server.');
        }

        return $this->client->makeRequest($url, $typeRequest, $params);
    }


}