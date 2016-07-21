<?php
    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 12/02/16
     * Time: 16:06
     */

    namespace MsiClient;


    use GuzzleHttp\Client;
    use GuzzleHttp\Exception\ClientException;
    use GuzzleHttp\Exception\ServerException;
    use MsiClient\Central\Factory\Formatter;
    use MsiClient\Error\ErrorClientFactory;
    use MsiClient\Error\ErrorClientInterface;
    use Psr\Http\Message\ResponseInterface;

    /***
     * Class that estabilish the basic functions to connect with the server.
     * It must be provided to instantiate a Client for it be able to know where to connect.
     * Class Server
     * @package MsiClient
     */
    class Server
    {

        protected $errorclient;

        /***
         *
         * Once acquired the token will be saved at the server.
         * @var Token
         */
        protected $token;

        /**
         *
         * Server hosts
         * Where the requests must be done to.
         * @var string
         */
        protected $host;


        public function __construct($host)
        {
            $this->host = $host;
        }

        public function getHost()
        {
            return $this->host;
        }

        public function createErrorclient($errorClient = 'bugsnag', $apiKey = null)
        {
            $this->setErrorClient(ErrorClientFactory::create($errorClient, $apiKey));
        }

        public function setErrorClient(ErrorClientInterface $errorClient)
        {
            $this->errorclient = $errorClient;
        }

        public function getErrorclient()
        {

            if (is_null($this->errorclient)) {
                $this->createErrorclient();
            }

            return $this->errorclient;
        }

        /**
         * @param Token $token
         */
        public function setToken(Token $token)
        {
            $this->token = $token;
        }

        public function getToken()
        {
            return $this->token;
        }


        public function callApi($type, $url, $params)
        {
            $client = new Client();

            try {

                if ($type == \MsiClient\Client::GET_REQUEST && isset($params['form_params'])) {
                    unset($params['form_params']);
                }

                $response = $client->request($type, $url, $params);

                return $this->_parse($response);

            } catch (ClientException $e) {
                throw new \MsiClient\Exception\ServerException("Não foi possível completar a requisição para url: $url",
                    $e->getMessage(), 400, $params, [], $this->getErrorclient(), $e);
            } catch (\ErrorException $e) {
                throw new \MsiClient\Exception\ServerException("Não foi possível realiazar a requisição a url: $url",
                    $e->getMessage(), 100, $params, [], $this->getErrorclient(), $e);
            } catch (ServerException $e) {
                throw new \MsiClient\Exception\ServerException("A resposta da url não estava compreensível url: $url",
                    $e->getMessage(), 500, $params, $e->getResponse()->getBody()->getContents(),
                    $this->getErrorclient(), $e);
            } catch (\Exception $e) {
                throw new \MsiClient\Exception\ServerException("Erro genérico não parseado", $e->getMessage(), 500,
                    $params, [], $this->getErrorclient(), $e);
            }
        }


        public function isSsl()
        {
            return strpos($this->host, 'https://') === 0;
        }

        private function _parse(ResponseInterface $response)
        {

            $contentType = $response->getHeader('Content-Type');
            if (is_null($contentType)) {
                return $response->getBody();
            }

            $formatter = Formatter::create($contentType[0]);

            if (is_null($formatter)) {
                return $response->getBody()->getContents();
            }

            return $formatter->decode($response->getBody());
        }
    }