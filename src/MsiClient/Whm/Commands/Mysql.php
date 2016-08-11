<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 03/03/16
 * Time: 12:23
 */

namespace MsiClient\Whm\Commands;

use MsiClient\Whm\Exception\InvalidRequest;

class Mysql extends Command
{

    const ALTER = 'ALTER';
    const ALTER_ROUTINE = 'ALTER ROUTINE';
    const CREATE = 'CREATE';
    const CREATE_ROUTINE = 'CREATE ROUTINE';
    const CREATE_TEMPORARY_TABLES = 'CREATE TEMPORARY TABLES';
    const CREATE_VIEW = 'CREATE_VIEW';
    const DELETE = 'DELETE';
    const DROP = 'DROP';
    const EVENT = 'EVENT';
    const EXECUTE = 'EXECUTE';
    const INDEX = 'INDEX';
    const INSERT = 'INSERT';
    const LOCK_TABLES = 'LOCK TABLES';
    const REFERENCES = 'REFERENCES';
    const SELECT = 'SELECT';
    const SHOW_VIEW = 'SHOW_VIEW';
    const TRIGGER = 'TRIGGER';
    const UPDATE = 'UPDATE';
    const ALL_PRIVILEGES = 'ALL PRIVILEGES';

    public function createDatabase($databaseName)
    {

        $retorno = $this->perform([
            'db' => $this->addAcc($databaseName),
            'cpanel_jsonapi_module' => 'MysqlFE',
            'cpanel_jsonapi_func' => 'createdb',
            'cpanel_jsonapi_apiversion' => 2
        ], \MsiClient\Client::GET_REQUEST, $this->getUrl('cpanel'))->cpanelresult;

        if (empty($retorno->data)) {
            throw  new InvalidRequest("Ocorreu um erro na requisição." . $retorno->error);
        }

        return true;
    }

    public function deleteDatabase($databaseName)
    {
        $retorno = $this->perform([
            'db' => $this->addAcc($databaseName),
            'cpanel_jsonapi_module' => 'MysqlFE',
            'cpanel_jsonapi_func' => 'deletedb',
            'cpanel_jsonapi_apiversion' => 2
        ], \MsiClient\Client::GET_REQUEST, $this->getUrl('cpanel'))->cpanelresult;

        if (empty($retorno->data)) {
            throw  new InvalidRequest("Ocorreu um erro na requisição." . $retorno->error);
        }

        return true;
    }

    public function createDbUser($mysqlUserName, $mysqlPass)
    {
        $retorno = $this->perform([
            'dbuser' => $this->addAcc($mysqlUserName),
            'password' => $mysqlPass,
            'cpanel_jsonapi_module' => 'MysqlFE',
            'cpanel_jsonapi_func' => 'createdbuser',
            'cpanel_jsonapi_apiversion' => 2
        ], \MsiClient\Client::GET_REQUEST, $this->getUrl('cpanel'))->cpanelresult;
        if (empty($retorno->data)) {
            throw  new InvalidRequest("Ocorreu um erro na requisição." . $retorno->error);
        }

        return true;
    }

    public function deleteDbUser($mysqlUserName)
    {
        $retorno = $this->perform([
            'dbuser' => $this->addAcc($mysqlUserName),
            'cpanel_jsonapi_module' => 'MysqlFE',
            'cpanel_jsonapi_func' => 'deletedbuser',
            'cpanel_jsonapi_apiversion' => 2
        ], \MsiClient\Client::GET_REQUEST, $this->getUrl('cpanel'))->cpanelresult;

        if (empty($retorno->data)) {
            throw  new InvalidRequest("Ocorreu um erro na requisição." . $retorno->error);
        }

        return true;
    }

    /**
     * @param $user
     * @param $dbName
     * @param $privilleges comma separated, please see the constants of this class.
     * @return bool
     * @throws InvalidRequest
     * @throws \MsiClient\Central\Exception\General
     */
    public function addPrivilleges($user, $dbName, $privilleges)
    {
        $retorno = $this->perform([
            'db' => $this->addAcc($dbName),
            'dbuser' => $this->addAcc($user),
            'privileges' => $privilleges,
            'cpanel_jsonapi_module' => 'MysqlFE',
            'cpanel_jsonapi_func' => 'setdbuserprivileges',
            'cpanel_jsonapi_apiversion' => 2
        ], \MsiClient\Client::GET_REQUEST, $this->getUrl('cpanel'))->cpanelresult;

        if ($retorno->event->result != '1') {
            throw  new InvalidRequest("Ocorreu um erro na requisição." . $retorno->error);
        }

        return true;
    }


    public function revokePrivilleges($user, $dbName)
    {
        $retorno = $this->perform([
            'db' => $this->addAcc($dbName),
            'dbuser' => $this->addAcc($user),
            'cpanel_jsonapi_module' => 'MysqlFE',
            'cpanel_jsonapi_func' => 'revokedbuserprivileges',
            'cpanel_jsonapi_apiversion' => 2
        ], \MsiClient\Client::GET_REQUEST, $this->getUrl('cpanel'))->cpanelresult;


        if ($retorno->event->result != '1') {
            throw  new InvalidRequest("Ocorreu um erro na requisição." . $retorno->error);
        }

        return true;
    }

    public function listDatabase()
    {
        $retorno = $this->perform([
            'cpanel_jsonapi_module' => 'MysqlFE',
            'cpanel_jsonapi_func' => 'listdbs',
            'cpanel_jsonapi_apiversion' => 2
        ], \MsiClient\Client::GET_REQUEST, $this->getUrl('cpanel'))->cpanelresult;

        if (!$retorno->event->result) {
            throw  new InvalidRequest("Ocorreu um erro na requisição." . $retorno->error);
        }

        $dbs = [];

        foreach ($retorno->data as $db) {
            $dbs[] = $db->db;
        }

        return $dbs;
    }

    public function userExists($user)
    {
        $retorno = $this->perform([
            'dbuser' => $this->addAcc($user),
            'cpanel_jsonapi_module' => 'MysqlFE',
            'cpanel_jsonapi_func' => 'dbuserexists',
            'cpanel_jsonapi_apiversion' => 2
        ], \MsiClient\Client::GET_REQUEST, $this->getUrl('cpanel'))->cpanelresult;

        if ($retorno->event->result != '1') {
            throw  new InvalidRequest("Ocorreu um erro na requisição." . $retorno->error);
        }

        return $retorno->data[0] != 0;
    }


    public function grantAccessHost( $host ) {
        $retorno = $this->perform([
            'host' => $host,
            'cpanel_jsonapi_module' => 'MysqlFE',
            'cpanel_jsonapi_func' => 'authorizehost',
            'cpanel_jsonapi_apiversion' => 2
        ], \MsiClient\Client::GET_REQUEST, $this->getUrl('cpanel'))->cpanelresult;

        if ($retorno->event->result != '1') {
            throw  new InvalidRequest("Ocorreu um erro na requisição." . $retorno->error);
        }

        return true;
    }

    private function getPrefix()
    {
        return $this->acc . '_';
    }

    public function addPrefix($dbName)
    {
        return $this->addAcc($dbName);
    }

    private function addAcc($nome)
    {

        $prefix = $this->getPrefix();

        if (strpos($nome, $prefix) === 0) {
            return $nome;
        }

        return $prefix . $nome;
    }


    public function needAcc()
    {
        return true;
    }
}