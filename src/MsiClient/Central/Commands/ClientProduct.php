<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 11/03/16
 * Time: 11:24
 */

namespace MsiClient\Central\Commands;


use MsiClient\Central\Commands\Properties\ClientProductProperties;

class ClientProduct extends Command
{

    public $url = "/client-product/";

    public function show($id)
    {
        try {
            $result = $this->perform([], \MsiClient\Client::GET_REQUEST, $this->getUrl() . $id)->data;
            $clientProduct = new ClientProductProperties();


            return $clientProduct->fromStdClass($result);
        } catch (\Exception $e) {
            throw  $e;
        }
    }
}