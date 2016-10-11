<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 12/02/16
 * Time: 16:03
 */

namespace MsiClient;

use MsiClient\Central\Exception\General;
use MsiClient\Central\Formatter\IFormatter;
use MsiClient\Exception\ServerException;

/***
 * Basic class to communicate with the api server.
 * Class Client
 * @package MsiClient
 */
class Client
{

    const GET_REQUEST = 'GET';

    const POST_REQUEST = 'POST';

    const PUT_REQUEST = 'PUT';

    const DELETE_REQUEST = 'DELETE';

    const Formart_Request = 'application/json';

    const Mysuite_Request = 'application/xml';

    protected $headers = [];

    /**
     * @var Server the client is connected with.
     */
    protected $server;

    /**
     *
     * @param Server $server Server the Client will be connect with.
     */
    public function __construct(Server $server)
    {
        $this->server = $server;
    }

    public function getHost()
    {
        return $this->server->getHost();
    }

    protected function getQuery($params = null)
    {

        if (empty($params)) {
            $params = [];
        }

        if (empty($this->server->getToken())) {
            return $params;
        }


        return array_merge($params, ['access_token' => $this->server->getToken()->access_token]);
    }


    public function makeRequest($url, $type, $params = null, $parse = true, IFormatter $formatter = null)
    {

        if ($parse) {

            $query = $this->getQuery($params);
            $params = ['form_params' => $query, 'query' => $query];
        }


        if ($this->server->isSsl()) {
            $this->headers['verify'] = false;

            $this->headers['curl'] = [
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,

            ];
        }

        if (($type == Client::PUT_REQUEST || $type == Client::DELETE_REQUEST) && !is_null($this->server->getToken())) {
            $this->headers['headers']['Authorization'] = 'Bearer ' . $this->server->getToken()->access_token;
        }


        $params = array_merge($params, $this->headers);

        if ($formatter == null) {
            return $this->server->callApi($type, $url, $params);
        }

        return $formatter->decode($this->server->callApi($type, $url, $params));
    }

    /**
     * @param string $clientId Client Id used for the first authentication.
     *
     * @return  bool string Either if it found or didn't found a token, It also takes in consideration if the Token
     *               has expired or not. Restore a token, preventing from the need to do another authentication on
     *               the server.
     * @throws General Something went wrong... it shouldn't be happening.
     * @throws \Exception Something went wrong with the login or the login wasn't valid.
     */
    public function restoreToken($clientId)
    {

        try {
            $token = Token::restore($clientId);

            if (is_null($token)) {
                return false;
            }

            if (!!$token->expired()) {
                $this->setToken($token);

                return true;
            }

            /***
             * @var ILogin $iLogin
             */
            $iLogin = new $token->from;
            $iLogin->setClient($this);

            $newToken = $iLogin->login($token);
            $newToken->preserve;

            if (is_null($token)) {
                return false;
            }

            $this->setToken($newToken);

            return true;

        } catch (ServerException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw new General($e->getMessage(), $e->getCode(), $e);
        }

    }

    /**
     * @return Token
     */
    public function getToken()
    {
        return $this->server->getToken();
    }

    public function setToken(Token $token)
    {
        $this->server->setToken($token);
    }

    public function setAuthorization($user, $password)
    {
        $this->headers['headers']['Authorization'] = "{$user}:{$password}";
    }

    public function addHeader($header, $value, $overwrite = false)
    {

        if (isset($this->headers[$header]) && $overwrite == false) {
            throw new \Exception('Header já setado');
        }

        $this->headers['headers'][$header] = $value;
    }

    public function getServer()
    {
        return $this->server;
    }
}