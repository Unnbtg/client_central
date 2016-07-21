<?php
    /**
     * Created by PhpStorm.
     * User: Marco
     * Date: 24/02/2016
     * Time: 18:07
     */

    namespace MsiClient\Central\Commands;

    use MsiClient\Central\Commands\Properties\UserProperties;

    class User extends Command
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

            return $this->storeRequest($this->getUrl() . '/' . $userProperties->id, $type, $userProperties);

        }

        public function dataTable($data)
        {
            try {
                return $this->perform($data, \MsiClient\Client::POST_REQUEST, $this->getUrl().'/datatable');
            } catch (\Exception $e) {
                throw  $e;
            }
        }

        public function destroy($id) {
            try {
                return $this->perform([], \MsiClient\Client::DELETE_REQUEST, $this->getUrl().'/'.$id);
            } catch (\Exception $e) {
                throw  $e;
            }
        }

    }