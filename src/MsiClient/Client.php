<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 12/02/16
 * Time: 16:03
 */

namespace MsiClient;

use MsiClient\Central\Exception\General;

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


    public function makeRequest($url, $type, $params)
    {
        return $this->server->callApi($type, $url, $params);
    }

    /***
     * Restore a token, preventing from the need to do another authentication on the server.
     * @param string $clientId Client Id used for the first authentication.
     * @return bool string Either if it found or didn't found a token, It also takes in consideration if the Token has expired or not.
     * @throws General Something went wrong... it shouldn't be happening.
     * @throws Server Something went wrong with the login or the login wasn't valid.
     * @throws \Exception Unknown area.
     */
    public function restoreToken($clientId) {

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

            $newToken  = $iLogin->login($token);
            $newToken->preserve;

            if (is_null($token)) {
                return false;
            }

            $this->setToken($newToken);
            return true;

        } catch ( MsiClient\Central\Exception\Server $e) {
            throw $e;
        } catch (\Exception $e) {
            throw new General($e->getMessage(), $e->getCode(), $e);
        }

    }

    public function setToken(Token $token)
    {
        $this->server->setToken($token);
    }


}