<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 12/02/16
 * Time: 16:06
 */

namespace MsiClient;


use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use MsiClient\Authorization\Authorizable;
use MsiClient\Central\Factory\Formatter;
use MsiClient\Error\ErrorClientFactory;
use MsiClient\Error\ErrorClientInterface;
use Psr\Http\Message\ResponseInterface;

/***
 * Class that estabilish the basic functions to connect with the server.
 * It must be provided to instantiate a Client for it be able to know where to connect.
 * Class Server
 * @package MsiClient
 */
class Server
{


    /**
     * @var Authorizable[]
     */
    protected $autorizables;

    protected $errorclient;

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


    public function addAuthorizable($auth)
    {
        $this->autorizables[] = $auth;
    }

    public function createErrorclient($errorClient = 'bugsnag', $apiKey = null)
    {
        $this->setErrorClient(ErrorClientFactory::create($errorClient, $apiKey));
    }

    public function setErrorClient(ErrorClientInterface $errorClient)
    {
        $this->errorclient = $errorClient;
    }

    public function getErrorclient()
    {

        if (is_null($this->errorclient)) {
            $this->createErrorclient();
        }

        return $this->errorclient;
    }

    /**
     * @param Token $token
     */
    public function setToken(Token $token)
    {
        $this->token = $token;
    }

    public function getToken()
    {
        return $this->token;
    }


    public function callApi($type, $url, $params)
    {
        $client = new GuzzleClient();

        try {

            $params = $this->applyAuth($params);

            if ($type == \MsiClient\Client::GET_REQUEST && isset($params['form_params'])) {
                unset($params['form_params']);
            }

            if (in_array($type,
                    [\MsiClient\Client::POST_REQUEST, \MsiClient\Client::PUT_REQUEST]) && isset($params['query'])
            ) {
                unset($params['query']);
            }
            $params['connect_timeout'] = 600;
            $response = $client->request($type, $url, $params);
            return $this->_parse($response);

        } catch (ClientException $e) {
            $client = $this->getErrorclient();
            if ($e->getResponse()->getStatusCode() == 403) {
                $client = null;
            }

            throw new \MsiClient\Exception\ServerException("Não foi possível completar a requisição para url: $url",
                $e->getMessage(), 400, $params, [], $client, $e, $e->getResponse());
        } catch (\ErrorException $e) {

            throw new \MsiClient\Exception\ServerException("Não foi possível realiazar a requisição a url: $url",
                $e->getMessage(), 100, $params, [], $this->getErrorclient(), $e);
        } catch (ServerException $e) {
            echo $e->getResponse()->getBody();
            exit;
            throw new \MsiClient\Exception\ServerException("A resposta da url não estava compreensível url: $url",
                $e->getMessage(), 500, $params, $this->_parse($e->getResponse()),
                $this->getErrorclient(), $e, $e->getResponse());
        } catch (\Exception $e) {

            $std = new \stdClass();
            $std->data = "Ocorreu um erro ao realizar a requisição, tente novamente.";

            throw new \MsiClient\Exception\ServerException("Erro genérico não parseado", $e->getMessage(), 500,
                $params, $std, $this->getErrorclient(), $e);
        }
    }


    public function isSsl()
    {
        return strpos($this->host, 'https://') === 0;
    }

    private function _parse(ResponseInterface $response)
    {
        $contentType = $response->getHeader('Content-Type');
        if (is_null($contentType)) {
            return $response->getBody();
        }

        $formatter = Formatter::create($contentType[0]);

        if (is_null($formatter)) {
            return $response->getBody()->getContents();
        }

        return $formatter->decode($response->getBody());
    }


    public function applyAuth($params)
    {

        if (empty($this->autorizables)) {
            return $params;
        }

        foreach ($this->autorizables as $auth) {
            $params = $auth->apply($params);
        }

        return $params;
    }
}