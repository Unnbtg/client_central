<?php
    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 12/02/16
     * Time: 16:42
     */

    namespace MsiClient\Central\Commands;

    use MsiClient\Central\Commands\Properties\PropertiesAbstract;
    use MsiClient\Central\Commands\Properties\Sendable;
    use MsiClient\Central\Exception\CentralException;
    use MsiClient\Central\Exception\General;
    use MsiClient\Central\Exception\Server;
    use MsiClient\Central\Factory\Formatter;
    use MsiClient\Client;

    abstract class Command
    {

        /***
         * @var Client $client
         */
        public $client;

        protected $url;


        public function getUrl()
        {
            return $this->client->getHost() . $this->url;
        }


        /**
         * @param Client $client
         */
        public function setClient(Client $client)
        {
            $this->client = $client;
        }

        /**
         *
         * Perform what the command is intended to do.
         *
         * @param mixed       $params      An array with the values the command need to do the action.
         * @param string      $typeRequest Type of the request
         * @param string|null $url
         *
         * @return array|\Psr\Http\Message\StreamInterface|string
         * @throws \Exception
         */
        protected function perform($params, $typeRequest, $url = null)
        {
            try {
                if (is_null($url)) {
                    $url = $this->getUrl();
                }

                if (empty($this->client)) {
                    throw new General('You must provide a MSiClient\Central\Client in order to perform any requisition to the server.');
                }

                return $this->client->makeRequest($url, $typeRequest, $params);
            } catch (Server $e) {
                echo ($e->getMessage());
                exit;
                $response = $e->parsedResponse;
                echo $e->parsedResponse;
                exit;
                if ( ! is_null($response) && $response->error == true) {
                    throw new CentralException($e->getMessage(), $e->getCode(), $response->details, $e);
                }

                throw $e;
            } catch (\Exception $e) {
                var_dump($e);
                exit;
                throw  $e;
            }
        }

        /**
         * @param       $type PropertiesAbstract class type
         * @param array $values
         *
         * @return PropertiesAbstract
         */
        protected function createPropertieType($type, $values)
        {
            if ( ! is_array($values)) {
                return $values;
            }

            $typeInstance = new $type;

            foreach ($values as $key => $value) {
                $typeInstance->$key = $value;
            }

            return $typeInstance;
        }

        protected function isSendable($type)
        {
            return $type instanceof Sendable;
        }


        protected function getSendData(PropertiesAbstract $type)
        {
            $formatter = Formatter::create(Client::Formart_Request);

            return [
                'data' => $formatter->encode([$type->getContainer() => $type->toArray()]),
            ];
        }

        protected function storeRequest($url, $typeRequest, PropertiesAbstract $properties)
        {
            if ( ! $this->isSendable($properties)) {
                throw new General("Was impossible to send the given data", General::WRONG_DATA);
            }

            $response = $this->perform($this->getSendData($properties), $typeRequest, $url);

            return $properties->fromStdClass($response->data);
        }


        protected function listRequest($url, PropertiesAbstract $propertiesAbstract)
        {
            $response = $this->perform([], Client::GET_REQUEST, $url)->data;

            $collection = [];
            foreach ($response as $item) {
                $collection[] = clone $propertiesAbstract->fromStdClass($item);
            }

            return $collection;
        }

        protected function showRequest($url, PropertiesAbstract $propertiesAbstract)
        {
            $response = $this->perform([], Client::GET_REQUEST, $url)->data;

            return $propertiesAbstract->fromStdClass($response);
        }
    }