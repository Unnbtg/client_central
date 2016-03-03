<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 12/02/16
 * Time: 16:42
 */

namespace MsiClient\Whm\Commands;


use MsiClient\Central\Exception\General;
use MsiClient\Central\Formatter\Json;
use MsiClient\Client;
use MsiClient\Whm\Exception\InvalidRequest;

abstract class Command
{

    /***
     * @var Client $client
     */
    public $client;

    protected $apiVersion = 1;

    protected $acc = null;

    public abstract function needAcc();

    public function getUrl($url = null)
    {
        return $this->client->getHost() . $url;
    }


    public function setAccount($acc)
    {
        return $this->acc = $acc;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
    }

    public function setApiVersion($version)
    {
        $this->apiVersion = $version;
    }

    /**
     * Perform what the command is intended to do.
     * @param mixed $parametros An array with the values the command need to do the action.
     * @param string $typeRequest Type of the request
     * @param null $url
     * @return array|\Guzzle\Http\EntityBodyInterface|string
     * @throws General
     * @throws InvalidRequest
     */
    protected function perform($parametros, $typeRequest, $url = null)
    {
        if (is_null($url)) {
            $url = $this->getUrl();
        }

        if (empty($this->client)) {
            throw new General('You must provide a MSiClient\Central\Client in order to perform any requisition to the server.');
        }

        if ($this->needAcc() && is_null($this->acc)) {
            throw new InvalidRequest("É preciso fornecer qual conta será utilizada para este método, verifique o método setAccount");
        }

        if (is_null($parametros)) {
            $parametros = [];
        }

        if ($this->needAcc()) {
            $parametros['cpanel_jsonapi_user'] = $this->acc;
        }

        if ($typeRequest == Client::POST_REQUEST) {
            $params['form_params'] = $parametros;
            $params['query'] = ['api.version' => $this->apiVersion];
        } else {
            $params['query'] = array_merge($parametros, ['api.version' => $this->apiVersion]);
        }

        return $this->client->makeRequest($url, $typeRequest, $params, false, new Json());
    }





}