<?php
/**
 * Created by PhpStorm.
 * User: unm33
 * Date: 8/5/16
 * Time: 5:00 PM
 */

namespace MsiClient\SCIOnline\Commands;


use MsiClient\Client;

class LogoCommand extends Command
{

    protected $url = 'system/logo';

    public function store($filePath, $name = null, $masterKey, $code)
    {
        if (is_null($name)) {
            $name = uniqid();
        }
        $this->addFile($name, $filePath);
        return $this->perform([], Client::POST_REQUEST, $this->getUrl(), ["X-Root-Key" => $masterKey,'X-Sci-Instance' => $code,]);
    }
}