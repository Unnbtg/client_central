<?php
/**
 * Created by PhpStorm.
 * User: Marco
 * Date: 25/02/2016
 * Time: 11:45
 */

namespace MsiClient\Central\Commands;


use MsiClient\Central\Commands\Properties\ProductConfigurationProperties;
use MsiClient\Central\Factory\Formatter;

class SciOnline extends Command
{
    public $url = '/products/sci-online';

    public function getStatus($clientId)
    {
        return $this->perform([], \MsiClient\Client::GET_REQUEST, $this->getUrl() . '/status/' . $clientId);
    }

    public function setConfig(ProductConfigurationProperties $config)
    {
        $formatter = Formatter::create(\MsiClient\Client::Formart_Request);

        return $this->perform(
            ['data' => $formatter->encode(['sci-online' => $config->toArray()])],
            \MsiClient\Client::POST_REQUEST, $this->getUrl() . '/set-config');
    }

}