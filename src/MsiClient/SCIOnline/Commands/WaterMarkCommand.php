<?php
/**
 * Created by PhpStorm.
 * User: unm33
 * Date: 8/5/16
 * Time: 9:39 AM
 */

namespace MsiClient\SCIOnline\Commands;


use MsiClient\Client;

class WaterMarkCommand extends Command
{


    protected $url = 'system/watermark';

    public function store($filePath, $name = null, $masterKey, $code)
    {
        if (is_null($name)) {
            $name = uniqid();
        }
        $this->addFile($name, $filePath);
        return $this->perform([], Client::POST_REQUEST, $this->getUrl(), ["X-Root-Key" => $masterKey,'X-Sci-Instance' => $code,]);
    }

}