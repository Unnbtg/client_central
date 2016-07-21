<?php
    /**
     * Created by PhpStorm.
     * User: unm
     * Date: 7/24/16
     * Time: 12:56 PM
     */

    namespace MsiClient\Error;


    use MsiClient\Error\Clients\Bugsnagclient;

    class ErrorClientFactory
    {

        public static function create($errorclientType, $apiKey = null)
        {

            if (is_null($apiKey)) {
                $apiKey = '388d99c40269d49570227bdfb5e515eb';
            }

            switch ($errorclientType) {
                case 'bugsnag':
                    return new Bugsnagclient($apiKey);
            }

            return null;
        }

    }