<?php
    /**
     * Created by PhpStorm.
     * User: unm
     * Date: 7/24/16
     * Time: 12:54 PM
     */

    namespace MsiClient\Error;


    interface ErrorClientInterface
    {
        public function addWarning($identifier, $message, $additionalInfo);

        public function addError($identifier, $message, $additionalInfo);

        public function addInfo($identifier, $message, $additionalInfo);
    }