<?php
/**
 * Created by PhpStorm.
 * User: Marco
 * Date: 25/02/2016
 * Time: 11:45
 */

namespace MsiClient\Central\Commands;


class SciOnline extends Command
{
    public $url = '/products/sci-online';

    public function getStatus($clientId) {
        return $this->perform([], \MsiClient\Client::GET_REQUEST, $this->getUrl().'/status/'.$clientId);
    }

}