<?php
    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 15/03/16
     * Time: 14:57
     */

    namespace MsiClient\Central\Commands;


    use MsiClient\Central\Commands\Properties\ClientProductConfigurationProperties;
    use MsiClient\Central\Factory\Formatter;


    class ClientProductConfiguration extends Command
    {

        public $url = "/client-product-configuration";


        public function update(ClientProductConfigurationProperties $config)
        {
            try {
                $formatter = Formatter::create(\MsiClient\Client::Formart_Request);

                return $this->perform(['data' => $formatter->encode(['client_product_config' => $config->toArray()])],
                    \MsiClient\Client::PUT_REQUEST,
                    $this->getUrl() . '/' . $config->client_product_id . '-' . $config->product_configuration_id);

            } catch (\Exception $e) {
                throw  $e;
            }
        }

        /**
         * @param ClientProductConfigurationProperties[] $config
         *
         * @return array|\Guzzle\Http\EntityBodyInterface|string
         * @throws \Exception
         */
        public function updateMany($config)
        {
            try {
                $formatter = Formatter::create(\MsiClient\Client::Formart_Request);

                return $this->perform(['data' => $formatter->encode(['client_product_config' => $config])],
                    \MsiClient\Client::PUT_REQUEST, $this->getUrl() . '/update-many');

            } catch (\Exception $e) {
                throw  $e;
            }

        }

    }