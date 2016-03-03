<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 03/03/16
 * Time: 15:38
 */

namespace MsiClient\Whm\Commands;


class Park extends Command
{
    public function needAcc()
    {
        return true;
    }


    public function createPatk($subdomain, $topDomain)
    {
        $retorno = $this->perform([
            'domain' => $subdomain,
            'topdomain' => $topDomain,
            'cpanel_jsonapi_module' => 'Park',
            'cpanel_jsonapi_func' => 'park',
            'cpanel_jsonapi_apiversion' => 2
        ], \MsiClient\Client::POST_REQUEST, $this->getUrl('cpanel'))->cpanelresult;

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


}