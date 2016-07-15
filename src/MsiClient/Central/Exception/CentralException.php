<?php
    /**
     * Created by PhpStorm.
     * User: unm
     * Date: 7/15/16
     * Time: 10:29 AM
     */

    namespace MsiClient\Central\Exception;


    use Exception;

    class CentralException extends \Exception
    {
        protected  $errors;

        public function __construct($message, $code, $errors, Exception $previous = null)
        {
            $this->errors = $errors;

            parent::__construct($message, $code, $previous);
        }

        public function getErrors() {
            return $this->errors;
        }

    }