<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 13/01/17
 * Time: 10:20
 */

namespace MsiClient\SCIOnline\Commands;




use MsiClient\Client;

class SettingsCommand extends Command
{

    protected $url = '/system';

    public function __construct(\MsiClient\Client $client)
    {
        $this->setClient($client);
    }


    public function updateSettings($settings, $masterKey, $instance)
    {
        return $this->json()->perform($settings, \MsiClient\Client::PUT_REQUEST, $this->getUrl() . '/overrides', [
            "X-Root-Key" => $masterKey,
            "X-Sci-Instance" => $instance,
            'Content-Type' => 'application/json'
        ]);
    }

    public function getQuantities($instance, $masterKey) {
        try {
            return $this->json()->perform([], \MsiClient\Client::GET_REQUEST, $this->getUrl() . '/instances/'.$instance, [
                "X-Root-Key" => $masterKey,
                "X-Sci-Instance" => $instance,
                'Content-Type' => 'application/json'
            ])->data;
        } catch (\Exception $e) {
            var_dump($e);exit;
        }

    }
}