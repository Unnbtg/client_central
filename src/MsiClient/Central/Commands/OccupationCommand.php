<?php
    /**
     * Created by PhpStorm.
     * User: unm
     * Date: 7/21/16
     * Time: 6:36 PM
     */

    namespace MsiClient\Central\Commands;


    use MsiClient\Central\Commands\Properties\OccupationProperties;

    class OccupationCommand extends Command
    {

        protected $url = '/occupation';

        public function __construct(\MsiClient\Client $client = null)
        {
            if (! is_null($client)) {
                $this->setClient($client);
            }
        }


        public function listAll() {
            return $this->listRequest($this->getUrl(), new OccupationProperties());
        }
    }