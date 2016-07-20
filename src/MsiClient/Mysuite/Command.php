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

    protected $sigla;

    protected $pass;

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
        $this->sigla = $sigla;
        $this->pass = $pass;
    }

    public function getMysuiteAuth()
    {
        return [
            'sigla' => $this->sigla,
            'pass'  => $this->pass
        ];
    }

    public function makeRequest($url, $type, $params = null, $parse = true, $formatter = true)
    {
        if(!$formatter){
            $this->formatter = null;
        }
        return $this->client->makeRequest($url, $type, $params, $parse, $this->formatter);
    }

    public function getUrl($uri)
    {
        return $this->client->getHost() . $uri;
    }
}