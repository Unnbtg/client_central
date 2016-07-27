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


    class UserCommand extends Command
    {
        public $url = '/user';

        public function __construct(\MsiClient\Client $client = null)
        {
            if ( ! is_null($client)) {
                $this->setClient($client);
            }
        }

        public function getVendor()
        {
            try {
                return $this->perform([], \MsiClient\Client::GET_REQUEST, $this->getUrl() . '/vendor');
            } catch (\Exception $e) {
                throw  $e;
            }
        }

        public function getCustomer()
        {
            try {
                return $this->perform([], \MsiClient\Client::GET_REQUEST, $this->getUrl() . '/customer');
            } catch (\Exception $e) {
                throw  $e;
            }
        }


        public function getUser($code)
        {
            try {
                return $this->perform([], \MsiClient\Client::GET_REQUEST, $this->getUrl() . '/' . $code);
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

            $type = empty($userProperties->id) ? \MsiClient\Client::POST_REQUEST : \MsiClient\Client::PUT_REQUEST;
            $url = empty($userProperties->id) ? $this->getUrl() : $this->getUrl() . '/' . $userProperties->id;


            return $this->storeRequest($url, $type, $userProperties);
        }

        public function dataTable($data)
        {
            try {
                return $this->perform($data, \MsiClient\Client::POST_REQUEST, $this->getUrl() . '/datatable');
            } catch (\Exception $e) {
                throw  $e;
            }
        }

        public function destroy($id)
        {
            try {
                return $this->perform([], \MsiClient\Client::DELETE_REQUEST, $this->getUrl() . '/' . $id);
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

            $formatter = \MsiClient\Central\Factory\Formatter::create(\MsiClient\Client::Formart_Request);
            return $this->perform(['data' => $formatter->encode(['permission' => $permissions])],
                \MsiClient\Client::POST_REQUEST, $this->getUrl() . "/$userId/permission/sync");


        }
    }