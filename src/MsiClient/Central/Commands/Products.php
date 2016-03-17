<?php
/**
 * Created by PhpStorm.
 * User: Marco
 * Date: 25/02/2016
 * Time: 14:23
 */

namespace MsiClient\Central\Commands;


class Products extends Command
{
    public $url = '/products';

    public function getStatus($clientId) {
        try {
            return $this->perform([], \MsiClient\Client::GET_REQUEST, $this->getUrl() . '/status/' . $clientId);
        } catch (\Exception $e) {
            throw  $e;
        }
    }
}