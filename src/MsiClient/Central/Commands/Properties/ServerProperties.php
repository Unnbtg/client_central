<?php
    /**
     * Created by PhpStorm.
     * User: unm
     * Date: 7/15/16
     * Time: 9:22 AM
     */

    namespace MsiClient\Central\Commands\Properties;


    /**
     * Class ServerProperties
     * @package MsiClient\Central\Commands\Properties
     *
     *
     * @property integer $id
     * @property string  $name
     * @property string  $domain
     * @property string  $ip_address
     * @property string  $vlan_alias
     * @property string  $access_key
     * @property string  $created_at
     * @property string  $updated_at
     * @property integer $user_id
     * @property string  $deleted_at
     *
     */
    class ServerProperties extends PropertiesAbstract
    {
        public function getContainer()
        {
            return "server";
        }


    }