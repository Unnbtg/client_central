<?php
    /**
     * Created by PhpStorm.
     * User: unm
     * Date: 7/24/16
     * Time: 12:58 PM
     */

    namespace MsiClient\Error\Clients;


    use MsiClient\Error\ErrorClientInterface;

    class Bugsnagclient extends \Bugsnag_Client implements ErrorClientInterface
    {
        public function addWarning($identifier, $message, $additionalInfo)
        {
            $this->notifyError($identifier, $message, $additionalInfo, 'warning');
        }

        public function addError($identifier, $message, $additionalInfo)
        {
            $this->notifyError($identifier, $message, $additionalInfo, 'error');
        }

        public function addInfo($identifier, $message, $additionalInfo)
        {
            $this->notifyError($identifier, $message, $additionalInfo, 'info');
        }


    }