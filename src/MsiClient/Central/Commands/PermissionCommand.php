<?php
    /**
     * Created by PhpStorm.
     * User: unm
     * Date: 7/25/16
     * Time: 11:21 AM
     */

    namespace MsiClient\Central\Commands;
    use MsiClient\Central\Commands\Properties\PermissionProperties;

    class PermissionCommand extends Command
    {

        public function __construct(\MsiClient\Client $client)
        {
            $this->setClient($client);
        }

        protected $url = '/permission';

        public function listAll()
        {
            return $this->listRequest($this->getUrl(), new PermissionProperties());
        }

    }