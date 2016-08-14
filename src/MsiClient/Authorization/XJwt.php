<?php
/**
 * Created by PhpStorm.
 * User: unm33
 * Date: 8/14/16
 * Time: 1:06 PM
 */

namespace MsiClient\Authorization;


class XJwt
{
    protected $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function apply($request)
    {
        $request['headers']['X-Authorization'] = 'Bearer ' . $this->token;

        return $request;
    }
}