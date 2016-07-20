<?php
/**
 * Created by PhpStorm.
 * User: Marco
 * Date: 26/02/2016
 * Time: 10:18
 */

namespace MsiClient\Central\Commands;


use MsiClient\Central\Commands\Properties\ClientUserProperties;
use MsiClient\Central\Factory\Formatter;

class ClientUser extends Command
{
    public $url = "/client-user";

    public function save(ClientUserProperties $clientUser)
    {
        $formatter = Formatter::create(\MsiClient\Client::Formart_Request);
        $retorno = $this->perform(
            ['data' => $formatter->encode(['client-user' => $clientUser->toArray()])],
            \MsiClient\Client::POST_REQUEST
        );

        return $retorno;
    }

    public function show($id)
    {
        $retorno = $this->perform([], \MsiClient\Client::GET_REQUEST, $this->getUrl() . '/' . $id);
        $user = new ClientUserProperties();
        return $user->fromStdClass($retorno->data);
    }
}