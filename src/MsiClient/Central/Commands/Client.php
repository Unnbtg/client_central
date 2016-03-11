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

    public function save(ClientProperties $client)
    {
        try {
            $formatter = Formatter::create(\MsiClient\Client::Formart_Request);

            if (!is_null($client->id)) {
                return $this->perform(
                    ['data' => $formatter->encode(['client' => $client->toArray()])],
                    \MsiClient\Client::PUT_REQUEST, $this->getUrl() . '/' . $client->id);
            } else {
                return $this->perform(
                    ['data' => $formatter->encode(['client' => $client->toArray()])],
                    \MsiClient\Client::POST_REQUEST);
            }

        } catch (\Exception $e) {
            throw  $e;
        }

    }

    public function listAll($page)
    {
        try {
            return $this->perform(['page' => $page], \MsiClient\Client::GET_REQUEST, $this->getUrl());
        } catch (\Exception $e) {
            throw  $e;
        }
    }

    public function getClient($code)
    {
        try {
            return $this->perform([], \MsiClient\Client::GET_REQUEST, $this->getUrl() . '/' . $code);
        } catch (\Exception $e) {
            throw  $e;
        }
    }

    public function getContacts($id)
    {
        try {
            return $this->perform([], \MsiClient\Client::GET_REQUEST, $this->getUrl() . '/contacts/' . $id);
        } catch (\Exception $e) {
            throw  $e;
        }
    }
}