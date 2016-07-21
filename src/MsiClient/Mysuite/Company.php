<?php

namespace MsiClient\Mysuite;

use MsiClient\Central\Factory\Formatter;
use MsiClient\Client;

/**
*
*/
class Company extends Command
{
    public function show($code)
    {
        $url = $this->getUrl('ws_getclientes.php');

        $params = [
            'codempresa' => $code,
            'sigla' => $this->sigla,
            'servicekey' => md5($this->sigla . $this->pass),
        ];

        return $this->makeRequest($url, 'POST', $params);
    }

    public function store($data)
    {
        $id = !empty($data['mysuite_id']) ? $data['mysuite_id'] : $data['id'];
        $params = array(
            'fc_nomeempresa'    => $data['name'],
            'fc_cnpj'           => $data['cpf_cnpj'],
            'fc_endereco'       => $data['address'],
            'fc_ct_numero'      => $data['number'],
            'fc_ct_bairro'      => $data['neighborhood'],
            'fc_ct_cidade'      => $data['city'],
            'fc_ct_estado'      => $data['uf'],
            'fc_ct_cep'         => $data['cep'],
            'fc_contato'        => '',
            'fc_obs'            => $data['code'],
            'fc_razaosocial'    => $data['company_name'],
            'fc_inscest'        => '',
            'fc_fone1'          => $data['phone1'],
            'fc_fone2'          => $data['phone2'],
            'fc_statuscli'      => $data['status'],
            'fc_vendedor_geral' => '',
            'codigooriginal'    => $data['id'],
            'servicekey'        => md5($this->sigla . $id . $this->pass)
        );

        $params = array_map('utf8_decode', $params);
        $url = str_replace('/webservices', '', $this->getUrl('cadcliente.php'));
        $response = $this->makeRequest($url, 'POST', $params, true, false);

        return empty($response);
    }
}
