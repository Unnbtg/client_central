<?php
/**
 * Created by PhpStorm.
 * User: Marco
 * Date: 23/02/2016
 * Time: 11:37
 */

namespace MsiClient\Central\Commands;

use MsiClient\Central\Commands\Properties\ClientProperties;
use MsiClient\Central\Factory\Formatter;

class Client extends Command
{
    public $url = '/client';

    public  function save(ClientProperties $client) {

        $formatter = Formatter::create(\MsiClient\Client::Formart_Request);

        return $this->perform($formatter->encode($client->toArray()), \MsiClient\Client::POST_REQUEST);
    }

    public function listAll($page) {
        return $this->perform(['page' => $page], \MsiClient\Client::GET_REQUEST, $this->getUrl());
    }

    public function getClient($code) {
        return $this->perform([], \MsiClient\Client::GET_REQUEST, $this->getUrl().'/'.$code);
    }

    public function getContacts($id) {
        return $this->perform([], \MsiClient\Client::GET_REQUEST, $this->getUrl().'/contacts/'.$id);
    }
}