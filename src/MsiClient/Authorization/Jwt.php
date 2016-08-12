<?php
/**
 * Created by PhpStorm.
 * User: unm33
 * Date: 8/5/16
 * Time: 9:40 AM
 */

namespace MsiClient\Authorization;


class Jwt implements Authorizable
{

    protected $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function apply($request)
    {
        $request['headers']['Authorization'] = 'Bearer ' . $this->token;
        $request['headers']['X-Authorization'] = 'Bearer ' . $this->token;

        return $request;
    }
}