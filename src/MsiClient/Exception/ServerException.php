<?php
    /**
     * Created by PhpStorm.
     * User: unm
     * Date: 7/24/16
     * Time: 1:05 PM
     */

    namespace MsiClient\Exception;


    use Exception;
    use MsiClient\Error\ErrorClientInterface;
    use Psr\Http\Message\ResponseInterface;

    class ServerException extends \Exception
    {
        protected $parsedResult;
        protected $response;
        protected $content;
        protected $responseContent;

        public function __construct(
            $humanReadableError,
            $programError,
            $code,
            $params = [],
            $parsedResult = null,
            ErrorClientInterface $errorClient = null,
            Exception $previous = null,
            ResponseInterface $response = null
        ) {
            $this->parsedResult = $parsedResult;
            $this->responseContent = $this->getResponseBody();

            parent::__construct($programError, $code, $previous);
            $this->response = $response;

            if ( ! is_null($errorClient)) {

                $additionalInfo = [
                    'sent'     => $params,
                    'response' => $this->responseContent,
                    'response_code' => $this->getResponseCode()
                ];


                //$this->notifyError($humanReadableError, $errorClient, $additionalInfo);
            }

        }

        public function notifyError($humanReadableError, ErrorClientInterface $erroclient, $additionalInfo)
        {

            $error = $this->getErrortype();

            switch ($error) {
                case 'info':
                    $erroclient->addInfo($humanReadableError, $this->message, $additionalInfo);
                    break;
                case 'warning':
                    $erroclient->addWarning($humanReadableError, $this->message, $additionalInfo);
                    break;
                case 'error':
                    $erroclient->addError($humanReadableError, $this->message, $additionalInfo);
                    break;
            }
        }

        public function getResponseCode()
        {
            if (is_null($this->response)){
                return null;
            }

            return $this->response->getStatusCode();
        }

        public function getResponseBody()
        {
            if (!empty($this->responseContent)) {
                return $this->responseContent;
            }

            if (is_null($this->response)) {
                return null;
            }

            if (! is_null($this->content)) {
                return $this->content;
            }

            return $this->content = $this->response->getBody()->getContents();
        }

        public function getErrortype()
        {
            switch (true) {
                case $this->code <= 100:
                    return 'info';
                case $this->code < 500:
                    return 'warning';
                default:
                    return 'error';
            }
        }

        public function getParsedResult()
        {
            return $this->parsedResult;
        }

    }