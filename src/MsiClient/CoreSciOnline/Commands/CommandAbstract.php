<?php
/**
 * Created by PhpStorm.
 * User: unm33
 * Date: 8/9/16
 * Time: 10:31 AM
 */

namespace MsiClient\CoreSciOnline\Commands;


use MsiClient\Central\Exception\General;

abstract class CommandAbstract
{

    /**
     * @var \MsiClient\Client
     */
    public $client;

    protected $url;

    public function getUrl() {
        return $this->client->getHost() . $this->url;
    }

    protected function perform($params, $typeRequest, $url = null)
    {

        if (is_null($url)) {
            $url = $this->getUrl();
        }

        if (empty($this->client)) {
            throw new General('You must provide a MSiClient\Central\Client in order to perform any requisition to the server.');
        }
        $toSend['json'] = $params;

        return $this->client->makeRequest($url, $typeRequest, $toSend, false);
    }

}