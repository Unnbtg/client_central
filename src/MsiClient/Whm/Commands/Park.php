<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 03/03/16
 * Time: 15:38
 */

namespace MsiClient\Whm\Commands;


use MsiClient\Whm\Exception\InvalidRequest;

class Park extends Command
{
    public function needAcc()
    {
        return true;
    }


    public function createPatk($subdomain, $topDomain = null)
    {

        $send = ['domain' => $subdomain,
                 'cpanel_jsonapi_module' => 'Park',
                 'cpanel_jsonapi_func' => 'park',
                 'cpanel_jsonapi_apiversion' => 2];

        if (!empty($send)) {
            $send['topdomain'] = $topDomain;
        }

        $retorno = $this->perform($send, \MsiClient\Client::POST_REQUEST, $this->getUrl('cpanel'))->cpanelresult;
        var_dump($retorno);
        if (empty($retorno->data)) {
            throw  new InvalidRequest("Ocorreu um erro na requisição." . $retorno->error);
        }

        return true;
    }


    public function unPark($subdomain)
    {
        $retorno = $this->perform([
            'domain' => $subdomain,
            'cpanel_jsonapi_module' => 'Park',
            'cpanel_jsonapi_func' => 'unpark',
            'cpanel_jsonapi_apiversion' => 2
        ], \MsiClient\Client::POST_REQUEST, $this->getUrl('cpanel'))->cpanelresult;

        if (empty($retorno->data)) {
            throw  new InvalidRequest("Ocorreu um erro na requisição." . $retorno->error);
        }

        return true;
    }

    public function listPark()
    {
        $retorno = $this->perform([
            'cpanel_jsonapi_module' => 'Park',
            'cpanel_jsonapi_func' => 'listparkeddomains',
            'cpanel_jsonapi_apiversion' => 2
        ], \MsiClient\Client::POST_REQUEST, $this->getUrl('cpanel'))->cpanelresult;
        var_dump($retorno);exit;
        if (empty($retorno->data)) {
            throw  new InvalidRequest("Ocorreu um erro na requisição." . $retorno->error);
        }

        return $retorno;
    }

}