<?php
    /**
     * Created by PhpStorm.
     * User: unm
     * Date: 7/21/16
     * Time: 2:05 PM
     */

    namespace MsiClient\Central\Commands\Properties;


    class UserProperties extends PropertiesAbstract
    {
        public function getContainer()
        {
            return 'user';
        }

    }