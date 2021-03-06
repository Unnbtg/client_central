<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 10/11/17
 * Time: 10:42 AM
 */

namespace MsiClient\Login\Commands;


use MsiClient\Client;
use MsiClient\Exception\ServerException;

class SystemCommand extends CommandAbstract
{


    protected $url = '/system';


    public function __construct(Client $client)
    {
        $this->setClient($client);
    }


    public function uninstall($code)
    {
        return $this->perform([], Client::POST_REQUEST, $this->getUrl().'/'.$code.'/uninstall');
    }

    public function checkEmail($email)
    {
        try {
            return $this->perform(['email' => $email], Client::POST_REQUEST, $this->getUrl().'/check-email');
        } catch (ServerException $e) {
            return false;
        }
    }
}