<?php
/**
 * Created by PhpStorm.
 * User: Marco
 * Date: 24/02/2016
 * Time: 18:07
 */

namespace MsiClient\Central\Commands;


class User extends Command
{
    public $url = '/user';

    public function getVendor() {
        return $this->perform([], \MsiClient\Client::GET_REQUEST, $this->getUrl().'/vendor');
    }

}