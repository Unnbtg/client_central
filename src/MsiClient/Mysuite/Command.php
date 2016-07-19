<?php

namespace MsiClient\Mysuite;

use MsiClient\Central\Factory\Formatter;
use MsiClient\Central\Formatter\IFormatter;
use MsiClient\Client;

abstract class Command
{
    public $client;

    protected $baseUri;

    protected $params = [];

    private $formatter;

    public function __construct()
    {
        $this->formatter = Formatter::create(Client::Mysuite_Request);
    }

    public function setClient(Client $client)
    {
        $this->client = $client;
    }

    protected function setBaseUri($baseUri)
    {
        $this->baseUri = $baseUri;
    }

    public function setMysuiteAuth($sigla, $pass)
    {
        $this->params = [
            'sigla' => $sigla,
            'servicekey' => md5($sigla . $pass)
        ];
    }

    public function makeRequest($url, $type, $params = null, $parse = true)
    {
        $this->params = array_merge($params, $this->params);
        return $this->client->makeRequest($url, $type, $this->params, $parse, $this->formatter);
    }

    public function getUrl($uri)
    {
        return $this->client->getHost() . $uri;
    }
}