<?php
/**
 * Created by PhpStorm.
 * User: unm33
 * Date: 8/5/16
 * Time: 9:41 AM
 */

namespace MsiClient\Authorization;


interface Authorizable
{
    public function apply($request);
}