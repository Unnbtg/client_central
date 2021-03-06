<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 7/25/16
 * Time: 12:24 PM
 */

namespace MsiClient\Central\Commands;

use MsiClient\Central\Commands\Properties\PermissionProperties;
use MsiClient\Central\Commands\Properties\UserProperties;
use \MsiClient\Client as FuckAtAll;

class UserCommand extends Command
{
    public $url = '/user';

    public function __construct(FuckAtAll $client = null)
    {
        if (!is_null($client)) {
            $this->setClient($client);
        }
    }

    public function getVendor()
    {
        try {
            return $this->perform([], FuckAtAll::GET_REQUEST, $this->getUrl() . '/vendor');
        } catch (\Exception $e) {
            throw  $e;
        }
    }

    public function getCustomer()
    {
        try {
            return $this->perform([], FuckAtAll::GET_REQUEST, $this->getUrl() . '/customer');
        } catch (\Exception $e) {
            throw  $e;
        }
    }


    public function getUser($code)
    {
        try {
            return $this->perform([], FuckAtAll::GET_REQUEST, $this->getUrl() . '/' . $code);
        } catch (\Exception $e) {
            throw  $e;
        }
    }

    public function store($user)
    {
        $userProperties = new UserProperties();

        if (is_array($user)) {
            $userProperties->massAssignment($user);
        }

        $type = empty($userProperties->id) ? FuckAtAll::POST_REQUEST : FuckAtAll::PUT_REQUEST;
        $url = empty($userProperties->id) ? $this->getUrl() : $this->getUrl() . '/' . $userProperties->id;


        return $this->storeRequest($url, $type, $userProperties);
    }

    public function dataTable($data)
    {
        try {
            return $this->perform($data, FuckAtAll::POST_REQUEST, $this->getUrl() . '/datatable');
        } catch (\Exception $e) {
            throw  $e;
        }
    }

    public function destroy($id)
    {
        try {
            return $this->perform([], FuckAtAll::DELETE_REQUEST, $this->getUrl() . '/' . $id);
        } catch (\Exception $e) {
            throw  $e;
        }
    }

    public function getPermissions($userId)
    {
        return $this->listRequest($this->getUrl() . "/$userId/permission", new PermissionProperties());
    }

    public function syncPermissions($userId, $permissions)
    {
        $formatter = \MsiClient\Central\Factory\Formatter::create(FuckAtAll::Formart_Request);
        return $this->perform(['data' => $formatter->encode(['permission' => $permissions])],
            FuckAtAll::POST_REQUEST, $this->getUrl() . "/$userId/permission/sync");
    }

    public function getByToken($userId, $token)
    {
        return $this->perform([], FuckAtAll::GET_REQUEST, $this->getUrl() . "/$userId/token/$token");
    }

    public function setRememberToken($identifier, $token)
    {

        return $this->perform(['token' => $token], FuckAtAll::PUT_REQUEST, $this->getUrl() . "/$identifier/remember-token");
    }

    public function getByCredentials($email, $password)
    {
        return $this->perform(
            [
                'email' => $email,
                'password' => $password,
            ], FuckAtAll::POST_REQUEST, $this->getUrl() . "/by-credentials");
    }
}