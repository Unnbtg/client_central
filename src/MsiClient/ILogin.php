<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 17/02/16
 * Time: 11:06
 */

namespace MsiClient;


/***
 * Interface ILogin
 * @package MsiClient
 */
interface ILogin
{
    /**
     * Does a login using a used Token.
     * @param Token $token
     * @return Token A new token with a longer expired date.
     */
    public function login(Token $token);

    /***
     * @param Client $client
     * @return mixed
     */
    public function setClient(Client $client);
}