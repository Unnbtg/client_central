<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 12/02/16
 * Time: 16:27
 */

namespace MsiClient\Central\Commands;


use MsiClient\Client;
use MsiClient\ILogin;
use MsiClient\Token;

class Login extends Command implements ILogin
{


    protected $url = '/oauth/access_token';

    public function getAccessToken($grant_type, $client_secret, $client_id, $preserve = false)
    {
        try {
            $response = $this->perform([
                'grant_type' => $grant_type,
                'client_secret' => $client_secret,
                'client_id' => $client_id
            ], Client::POST_REQUEST);

            $token = new Token();

            $token->access_token = $response->access_token;
            $token->expire = new \DateTime("+ {$response->expires_in} seconds");
            $token->token_type = $response->token_type;
            $token->from = self::class;
            $token->preserve = $preserve;

            if ($preserve) {
                $token->clientId = $client_id;
                $token->grantType = $grant_type;
                $token->clientSecret = $client_secret;
            }

            $token->store($client_id);
            return $token;
        } catch (\Exception $e) {
            throw  $e;
        }
    }

    /**
     * @inheritDoc
     */
    public function login(Token $token)
    {
        try {
            return $this->getAccessToken($token->grantType, $token->clientSecret, $token->clientId, $token->preserve);
        } catch (\Exception $e) {
            throw  $e;
        }
    }


}