<?php
    /**
     * Created by PhpStorm.
     * User: unm
     * Date: 7/15/16
     * Time: 9:26 AM
     */

    namespace MsiClient\Central\Commands;

    use MsiClient\Central\Commands\Properties\ServerProperties;


    /**
     * Class ServerCommand
     * @package MsiClient\Central\Commands
     */
    class ServerCommand extends Command
    {
        public function __construct(\MsiClient\Client $client = null)
        {
            $this->setClient($client);
        }

        public function store($server)
        {
            $serverProperty = $this->createPropertieType(ServerProperties::class, $server);

            $type = is_null($serverProperty->id) ? \MsiClient\Client::POST_REQUEST : \MsiClient\Client::PUT_REQUEST;

            return $this->storeRequest($this->getUrl() . '/server', \MsiClient\Client::POST_REQUEST, $serverProperty);
        }

        public function listAll()
        {
            return $this->listRequest($this->getUrl() . '/server', new ServerProperties());
        }

        public function show($id)
        {
            return $this->showRequest($this->getUrl() . '/server/' . $id, new ServerProperties());
        }

        public function destroy($id)
        {
            return $this->perform([], \MsiClient\Client::DELETE_REQUEST, $this->getUrl() . '/server/' . $id);
        }
    }