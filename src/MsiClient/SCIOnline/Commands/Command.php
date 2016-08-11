<?php
/**
 * Created by PhpStorm.
 * User: unm33
 * Date: 8/5/16
 * Time: 9:39 AM
 */

namespace MsiClient\SCIOnline\Commands;


use MsiClient\Central\Exception\General;
use MsiClient\Client;

class Command
{

    /***
     * @var Client $client
     */
    public $client;

    protected $url;


    public function getUrl()
    {
        return $this->client->getHost() . $this->url;
    }


    /**
     * @param Client $client
     */
    public function setClient(\MsiClient\Client $client)
    {
        $this->client = $client;
    }

    /**
     *
     * Perform what the command is intended to do.
     *
     * @param mixed $params An array with the values the command need to do the action.
     * @param string $typeRequest Type of the request
     * @param string|null $url
     * @param array $headers Headers a serem enviados
     * @return array|\Psr\Http\Message\StreamInterface|string
     * @throws \Exception
     */
    protected function perform($params, $typeRequest, $url = null, $headers = [])
    {
        if (is_null($url)) {
            $url = $this->getUrl();
        }

        if (empty($this->client)) {
            throw new General('You must provide a MSiClient\Central\Client in order to perform any requisition to the server.');
        }
        $toSend = [];
        $headers["Accept"] = 'application/json';
        $toSend ['headers'] = $headers;

        $verb = 'form_params';
        if ($typeRequest == \MsiClient\Client::GET_REQUEST) {
            $verb = 'query';
        }

        $toSend [$verb] = $params;

        return $this->client->makeRequest($url, $typeRequest, $toSend, false);
    }
}