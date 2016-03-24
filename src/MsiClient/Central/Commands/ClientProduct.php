<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 11/03/16
 * Time: 11:24
 */

namespace MsiClient\Central\Commands;


use MsiClient\Central\Commands\Properties\ClientProductProperties;
use MsiClient\Central\Factory\Formatter;

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

    public function save(ClientProductProperties $properties)
    {
        try {
            try {
                $formatter = Formatter::create(\MsiClient\Client::Formart_Request);

                if (!is_null($properties->id)) {
                    return $this->perform(
                        ['data' => $formatter->encode(['client_product' => $properties->toArray()])],
                        \MsiClient\Client::PUT_REQUEST, $this->getUrl() . '/' . $properties->id);
                } else {
                    return $this->perform(
                        ['data' => $formatter->encode(['client_product' => $properties->toArray()])],
                        \MsiClient\Client::POST_REQUEST);
                }

            } catch (\Exception $e) {
                throw  $e;
            }
        } catch (\Exception $e) {
            throw  $e;
        }
    }
}