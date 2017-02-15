<?php
/**
 * Created by PhpStorm.
 * User: unamed
 * Date: 09/02/17
 * Time: 12:21
 */

namespace MsiClient\Authorization;


class Token implements Authorizable
{
    protected $token;

    public function __construct($token)
    {
        $this->token = $token;
    }


    public function apply($request)
    {

        $request['headers']['Authorization'] = $this->token;
        $request['headers']['X-Authorization'] = $this->token;

        return $request;
    }

}