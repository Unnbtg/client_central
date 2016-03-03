<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 03/03/16
 * Time: 15:06
 */

namespace MsiClient\Whm\Commands;


class SubDomain extends Command
{
    public function needAcc()
    {
        return true;
    }


    public function addSubDomain($subdomain, $principal, $path, $disallowDot =  1)
    {
        $retorno = $this->perform([
            'domain' => $subdomain,
            'rootdomain' => $principal,
            'dir' => $path,
            'disallowdot' => $disallowDot,
            'cpanel_jsonapi_module' => 'SubDomain',
            'cpanel_jsonapi_func' => 'addsubdomain',
            'cpanel_jsonapi_apiversion' => 2
        ], \MsiClient\Client::POST_REQUEST, $this->getUrl('cpanel'))->cpanelresult;

        if (empty($retorno->data)) {
            throw  new InvalidRequest("Ocorreu um erro na requisição." . $retorno->error);
        }

        return true;
    }


    public function delSubDomain($subdomain)
    {
        $retorno = $this->perform([
            'domain' => $subdomain,
            'cpanel_jsonapi_module' => 'SubDomain',
            'cpanel_jsonapi_func' => 'delsubdomain',
            'cpanel_jsonapi_apiversion' => 2
        ], \MsiClient\Client::POST_REQUEST, $this->getUrl('cpanel'))->cpanelresult;

        if (empty($retorno->data)) {
            throw  new InvalidRequest("Ocorreu um erro na requisição." . $retorno->error);
        }

        return true;
    }

}