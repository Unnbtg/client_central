<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 01/03/16
 * Time: 17:35
 */

namespace MsiClient\Whm\Commands;


use MsiClient\Whm\Commands\Properties\AccountProperties;
use MsiClient\Whm\Exception\InvalidRequest;

class Account extends Command
{

    /***
     *
     * List all users registered on the server
     * @param null $name if passed will filter the result by the name passed
     * @return AccountProperties[]
     * @throws InvalidRequest if something goes wrong
     * @throws \MsiClient\Central\Exception\General if something really bad goes wrong
     */

    public function listAll($name = null)
    {
        $array = [];


        if (!is_null($name)) {
            $array = [
                'search' => $name,
                'searchmethod' => 'exact',
                'searchtype'   => 'user'
            ];
        }

        $retorno = $this->perform($array, \MsiClient\Client::POST_REQUEST, $this->getUrl("/listaccts"));

        if (!$retorno->metadata->result) {
            throw new InvalidRequest('Ocorreu um erro na requisição.');
        }

        $accs = [];

        foreach ($retorno->data->acct as $valor) {
            $accs[] = AccountProperties::create($valor);
        }

        return $accs;
    }


    public function create(AccountProperties $account)
    {
        $retorno = $this->perform($account->toArray(), \MsiClient\Client::POST_REQUEST, $this->getUrl('/createacct'));

        if (!$retorno->metadata->result) {
            throw new InvalidRequest('Ocorreu um erro na requisição.' . $retorno->metadata->reason);
        }

        return $retorno->data;
    }


    public function delete($acc, $keepDns = false)
    {

        $retorno = $this->perform(['user' => $acc, 'keepdns' => (int)$keepDns], \MsiClient\Client::POST_REQUEST, $this->getUrl('/removeacct'));

        if (!$retorno->metadata->result) {
            throw new InvalidRequest('Ocorreu um erro na requisição.' . $retorno->metadata->reason);
        }

        return true;;

    }

    public function suspend($acc, $reason)
    {

        $retorno = $this->perform(['user' => $acc, 'reason' => $reason], \MsiClient\Client::POST_REQUEST, $this->getUrl('/suspendacct'));

        if (!$retorno->metadata->result) {
            throw new InvalidRequest('Ocorreu um erro na requisição.' . $retorno->metadata->reason);
        }

        return true;

    }

    public function unsuspend($acc)
    {

        $retorno = $this->perform(['user' => $acc], \MsiClient\Client::POST_REQUEST, $this->getUrl('/unsuspendacct'));

        if (!$retorno->metadata->result) {
            throw new InvalidRequest('Ocorreu um erro na requisição.' . $retorno->metadata->reason);
        }

        return true;

    }

    public function needAcc()
    {
        return false;
    }


}