<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 12/02/16
 * Time: 16:06
 */

namespace MsiClient;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;
use MsiClient\Central\Factory\Formatter;

/***
 * Class that estabilish the basic functions to connect with the server.
 * It must be provided to instantiate a Client for it be able to know where to connect.
 * Class Server
 * @package MsiClient
 */
class Server
{

    /***
     *
     * Once acquired the token will be saved at the server.
     * @var Token
     */
    protected $token;

    /**
     *
     * Server hosts
     * Where the requests must be done to.
     * @var string
     */
    protected $host;


    public function __construct($host)
    {
        $this->host = $host;
    }

    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param Token $token
     */
    public function setToken(Token $token)
    {
        $this->token = $token;
    }

    protected function addToken($url) {
        if (empty($this->token)) {
            return $url;
        }

        return $url.'?access_token='. $this->token->access_token;
    }

    public function callApi($type, $url, $params)
    {
        $client = new Client();


        try {

            $response = $client->request($type, $this->addToken($url), ['form_params' => $params]);
            return $this->_parse($response);

        } catch (ClientException $e) {

            throw new \MsiClient\Central\Exception\Server($e->getResponse()->getBody(), $e->getCode(), $this->_parse($e->getResponse()), $e->getResponse(),
                $e->getRequest(), $e);
        }


    }


    private function _parse(Response $response)
    {

        $contentType  = $response->getHeader('Content-Type');

        if (is_null($contentType)) {
            return $response->getBody();
        }

        $formatter = Formatter::create($contentType[0]);

        if (is_null($formatter)) {
            return $response->getBody();
        }

        return $formatter->decode($response->getBody());
    }
}