<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 15/02/16
 * Time: 17:12
 */




include_once 'vendor/autoload.php';


try {

    $server = new \MsiClient\Server("http://api.central.local/");
    $client = new \MsiClient\Client($server);
    $login = new \MsiClient\Central\Commands\Login();

    $login->setClient($client);




    $token = $login->getAccessToken('client_credentials', '$2y$10$0QsvQBVdHmNQSUNpaf86bOuUNiYzBCJjY', '1');


    $cliente = new \MsiClient\Central\Commands\Client();
    $client->setToken($token);

    $param = new \MsiClient\Central\Commands\Properties\ClientProperties();

    $cliente->setClient($client);

    echo $cliente->getContacts(32);

} catch (\MsiClient\Central\Exception\Server $e) {
    echo $e->getMessage();
    echo 'deu ruim';
}
