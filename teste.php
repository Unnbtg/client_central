<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 15/02/16
 * Time: 17:12
 */




include_once 'vendor/autoload.php';


try {
    /*$server = new \MsiClient\Server("http://microsistec.mysuite.com.br/webservices/");

    $clientApi = new \MsiClient\Client($server);

    $mysuite = new \MsiClient\Mysuite\Company();
    $mysuite->setClient($clientApi);
    $mysuite->setMysuiteAuth('mcs', 'ccd2e1fe11a04cb8c31b8295c03d74d7');
    var_dump($mysuite->get(133));exit;*/


    /*$server = new \MsiClient\Server("https://192.168.0.138:2087/json-api/");

    $clientApi = new \MsiClient\Client($server);
    $clientApi->setAuthorization('WHM root', "f1e73ad6c972c0d2227fec870ccc46d978a7cd540c7aed3d23cf2ab26ee7ec7c7cb937e528c619f908ba44d0a517a359a3443d9134cfc607217d8087d3979f9dd29b2d7bdeff83dc635df2cc624b63443061a54253669f88609c829d34be8cae2dfe9c3695819ad78bcacc11bc3a9cddef5851214811b5e19579828a7e2f38257bf019275cecdb766a0dea8f2d659a3c9638fc1dbd9387d1a857f89170cb319b14af7c30631bc0bce122bb8bf4de1cfc7a3226f62dc1fdd32fdf36020ffd1e9d2c6b7408cdc3f7d0e8acb54838ce1f84e7a8a3bab5196e0c7cf4873c21974a1a8a6285c4b2867132baa83407d3eb1d5e06c184a8fac3812447360e5a7bb9a986f6d36135a0963ddd9623fd1363e28272d63082cb5b2701547ef82cfad0d571facef3195ddbc645b2417d07f22d1bd538c1dee581d717fe43209dc701ddd77a93db543eb6462967fb8c16b3cb48a37587f9564de653c64579132d603aeee80f4c0e793b6f226657faba3174c6b74e2065dd1ebae089ff6b5934aba71ee88e54ade01dd7829360058f7d75e83330666f16494ee8ffbb993790a540eb9a24c781d7eb43f412053f06cd7d663b64f22db887af1911f860244ffcd201d6bbf063193af130e78a90f8e9d5b4aa81e07651f7f7e9fe2c5ffc63dea44ea5d5a095804889");
    $acc = new \MsiClient\Whm\Commands\Account();
    $acc->setClient($clientApi);

    $toChange = new \MsiClient\Whm\Commands\Properties\AccountProperties();
    $toChange->username = 'u0142a';
    $toChange->domain = 'missoshiro.com';

    var_dump($acc->change($toChange));


    /*$server = new \MsiClient\Server( 'http://api.central.local');
    $cliente = new \MsiClient\Client($server);

    $login = new \MsiClient\Central\Commands\Login();
    $login->setClient($cliente);
    $token = $login->getAccessToken('client_credentials', '$2y$10$0QsvQBVdHmNQSUNpaf86bOuUNiYzBCJjY', '2', true);
    $cliente->setToken($token);

    $clientConfig = new \MsiClient\Central\Commands\ClientProductConfiguration();

    $teste1 = new \MsiClient\Central\Commands\Properties\ClientProductConfigurationProperties();
    $teste1->product_configuration_id = 1;
    $teste1->client_product_id = 3;
    $teste1->value = 4;


    $teste2 = new \MsiClient\Central\Commands\Properties\ClientProductConfigurationProperties();
    $teste2->product_configuration_id = 2;
    $teste2->client_product_id = 3;
    $teste2->value = 1;

    $clientConfig->setClient($cliente);
    var_dump($clientConfig->updateMany([$teste1, $teste2]));




    /*$server = new \MsiClient\Server("https://192.168.0.138:2087/json-api/");

    $clientApi = new \MsiClient\Client($server);
    $clientApi->setAuthorization('WHM root', "f1e73ad6c972c0d2227fec870ccc46d978a7cd540c7aed3d23cf2ab26ee7ec7c7cb937e528c619f908ba44d0a517a359a3443d9134cfc607217d8087d3979f9dd29b2d7bdeff83dc635df2cc624b63443061a54253669f88609c829d34be8cae2dfe9c3695819ad78bcacc11bc3a9cddef5851214811b5e19579828a7e2f38257bf019275cecdb766a0dea8f2d659a3c9638fc1dbd9387d1a857f89170cb319b14af7c30631bc0bce122bb8bf4de1cfc7a3226f62dc1fdd32fdf36020ffd1e9d2c6b7408cdc3f7d0e8acb54838ce1f84e7a8a3bab5196e0c7cf4873c21974a1a8a6285c4b2867132baa83407d3eb1d5e06c184a8fac3812447360e5a7bb9a986f6d36135a0963ddd9623fd1363e28272d63082cb5b2701547ef82cfad0d571facef3195ddbc645b2417d07f22d1bd538c1dee581d717fe43209dc701ddd77a93db543eb6462967fb8c16b3cb48a37587f9564de653c64579132d603aeee80f4c0e793b6f226657faba3174c6b74e2065dd1ebae089ff6b5934aba71ee88e54ade01dd7829360058f7d75e83330666f16494ee8ffbb993790a540eb9a24c781d7eb43f412053f06cd7d663b64f22db887af1911f860244ffcd201d6bbf063193af130e78a90f8e9d5b4aa81e07651f7f7e9fe2c5ffc63dea44ea5d5a095804889");
    $acc = new \MsiClient\Whm\Commands\Account();
    $acc->setClient($clientApi);
    //var_dump($acc->listAll('u406'));

    /*
        $acc = new \MsiClient\Whm\Commands\Account();
        $acc->setClient($clientApi);

        $r = $acc->listAll('cteste2');
        var_dump(getenv('cp_security_token'));
        exit;

        var_dump($r);

        exit;
        /*$dumbAcc = new \MsiClient\Whm\Commands\Properties\AccountProperties();
        $name = 'cteste5';
        $dumbAcc->username = $name;
        $dumbAcc->domain = $name.'.com.br';
        $dumbAcc->password = md5(uniqid());
        $dumbAcc->plan = 'Ilimitado';
        $dumbAcc->hasshell = false;
        $dumbAcc->contactemail = 'marco.augusto@microsistec.com.br';
        $dumbAcc->language = 'pt_br';

        $acc->create($dumbAcc);*/


    //var_dump($acc->delete('cteste5'));


    //var_dump($acc->suspend('cteste4', 'Não gostei da conta'));
    //ar_dump($acc->unsuspend('cteste4'));


   /* $download_url = "https://192.168.0.138:2083/login/";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
    curl_setopt($curl, CURLOPT_HEADER,0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($curl, CURLOPT_URL, $download_url);
    curl_setopt($curl, CURLOPT_POSTFIELDS, "user=cteste2&pass=123456");
    $result = curl_exec($curl);
    curl_close($curl);

    $parts = explode( 'URL=', $result);
    $session_parts = explode( '/frontend/', $parts[1]);
    $token = $session_parts[0];
    echo $token;*/

    //$mysql = new \MsiClient\Whm\Commands\Mysql();
    //$mysql->setClient($clientApi);
    //$mysql->setAccount('cteste2');
    //var_dump($mysql->createDatabase('cteste2_teste23', 'cteste2'));
    //var_dump($mysql->deleteDatabase('cteste2_teste23', 'cteste2'));
    //var_dump($mysql->createDbUser("abacate", 'abacate12340'));
    //var_dump($mysql->userExists("abacate"));
    //var_dump($mysql->deleteDbUser("abacate"));
    //var_dump($mysql->listDatabase());
    //var_dump($mysql->addPrivilleges('abacate', 'teste', \MsiClient\Whm\Commands\Mysql::ALL_PRIVILEGES));
    //var_dump($mysql->revokePrivilleges('abacate', 'teste'));


    /*$subDomain = new \MsiClient\Whm\Commands\SubDomain();
    $subDomain->setAccount('cteste2');
    $subDomain->setClient($clientApi);

    //var_dump($subDomain->addSubDomain('abacate', 'cteste2.com.br', '/abacate'));
    var_dump($subDomain->delSubDomain('abacate.cteste2.com.br'));
    */

    /*$park = new \MsiClient\Whm\Commands\Park();
    $park->setAccount('cteste2');
    $park->setClient($clientApi);

    //var_dump($park->createPatk('cteste2.microsistec.local', 'cteste2.com.br'));
    var_dump($park->unPark('cteste2.microsistec.local'));*/
    /*$server = new \MsiClient\Server("https://192.168.0.138:2087/json-api/");
    $clientApi = new \MsiClient\Client($server);
    $clientApi->setAuthorization('WHM root', "f1e73ad6c972c0d2227fec870ccc46d978a7cd540c7aed3d23cf2ab26ee7ec7c7cb937e528c619f908ba44d0a517a359a3443d9134cfc607217d8087d3979f9dd29b2d7bdeff83dc635df2cc624b63443061a54253669f88609c829d34be8cae2dfe9c3695819ad78bcacc11bc3a9cddef5851214811b5e19579828a7e2f38257bf019275cecdb766a0dea8f2d659a3c9638fc1dbd9387d1a857f89170cb319b14af7c30631bc0bce122bb8bf4de1cfc7a3226f62dc1fdd32fdf36020ffd1e9d2c6b7408cdc3f7d0e8acb54838ce1f84e7a8a3bab5196e0c7cf4873c21974a1a8a6285c4b2867132baa83407d3eb1d5e06c184a8fac3812447360e5a7bb9a986f6d36135a0963ddd9623fd1363e28272d63082cb5b2701547ef82cfad0d571facef3195ddbc645b2417d07f22d1bd538c1dee581d717fe43209dc701ddd77a93db543eb6462967fb8c16b3cb48a37587f9564de653c64579132d603aeee80f4c0e793b6f226657faba3174c6b74e2065dd1ebae089ff6b5934aba71ee88e54ade01dd7829360058f7d75e83330666f16494ee8ffbb993790a540eb9a24c781d7eb43f412053f06cd7d663b64f22db887af1911f860244ffcd201d6bbf063193af130e78a90f8e9d5b4aa81e07651f7f7e9fe2c5ffc63dea44ea5d5a095804889");

    $park = new \MsiClient\Whm\Commands\Park();
    $park->setAccount('u0142');
    $park->setClient($clientApi);
    //var_dump($park->createPatk('ahhhhhhhhhfodase.com'));

    var_dump($park->listPark());*/

    $server = new \MsiClient\Server( 'http://api.central_v2.local');
    $cliente = new \MsiClient\Client($server);

    $login = new \MsiClient\Central\Commands\Login();
    $login->setClient($cliente);
    $token = $login->getAccessToken('client_credentials', '$2y$10$0QsvQBVdHmNQSUNpaf86bOuUNiYzBCJjY', '2', true);
    $cliente->setToken($token);

    $cPlan = new \MsiClient\Central\Commands\Plan();
    $cPlan->setClient($cliente);

    var_dump($cPlan->getPlan(1));


} catch (\Exception $e) {
    echo $e->getMessage();
}
