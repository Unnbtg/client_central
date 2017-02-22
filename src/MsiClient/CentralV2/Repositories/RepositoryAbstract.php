<?php
/**
 * Created by PhpStorm.
 * User: unamed
 * Date: 09/02/17
 * Time: 12:26
 */

namespace MsiClient\CentralV2\Repositories;


use MsiClient\CentralV2\Entities\EntityFactory;
use MsiClient\Client;

class RepositoryAbstract implements RepositoryInterface
{
    /***
     * @var Client $client
     */
    public $client;

    protected $url;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    public function getUrl()
    {
        return $this->client->getServer()->getHost() . $this->url;
    }


    /**
     * @param Client $client
     */
    public function setClient(Client $client)
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
        $headers["Content-type"] = 'application/json';
        $toSend ['headers'] = $headers;
        $verb = 'form_params';
        if ($typeRequest == Client::GET_REQUEST) {
            $verb = 'query';
        }

        if ($typeRequest == Client::POST_REQUEST || $typeRequest == Client::PUT_REQUEST) {
            $verb = 'body';
            $params = json_encode($params);
        }
        $toSend[$verb] = $params;
        return $this->client->makeRequest($url, $typeRequest, $toSend, false);
    }

    public function update($identifier, $attributes)
    {
        return $this->perform($attributes, Client::PUT_REQUEST, $this->getUrl()."/$identifier");
    }

    public function get($params)
    {
        return $this->perform($params, Client::GET_REQUEST, $this->getUrl());
    }

    public function store($attributes)
    {
        return $this->perform($attributes, Client::POST_REQUEST, $this->getUrl());
    }

    public function find($identifier, $with = [])
    {
        return $this->perform(['with' => $with], Client::GET_REQUEST, $this->getUrl().'/'. $identifier);
    }

    public function delete($identifier)
    {
        return $this->perform([], Client::DELETE_REQUEST, $this->getUrl().'/'. $identifier);
    }
}