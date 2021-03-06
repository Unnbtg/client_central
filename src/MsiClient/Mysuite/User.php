<?php

namespace MsiClient\Mysuite;

use MsiClient\Central\Factory\Formatter;
use MsiClient\Client;

/**
*
*/
class User extends Command
{

    public function store($data)
    {
        $id = $data['codigooriginal'];

        $params = array(
            'fc_nomecompleto' => $data['name'],
            'fc_email1'       => $data['email'],
            'fc_email2'       => '',
            'fc_senha'        => '1111',
            'fc_obs'          => '',
            'codigooriginal'  => $id,
            'fc_codempresa'   => $data['fc_codempresa'],
            'fc_notenabled'   => 0,
            'nologin'         => 1,
            'servicekey'      => md5($this->sigla . $id . $data['email'] . $this->pass)
        );

        $params = array_map('utf8_decode', $params);
        $url = str_replace('/webservices', '', $this->getUrl('logininterno.php'));
        $response = $this->makeRequest($url, 'POST', $params, true, false);
    }

}
