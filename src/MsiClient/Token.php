<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 12/02/16
 * Time: 16:15
 */

namespace MsiClient;


class Token
{
    /**
     * @var string
     */
    public $access_token;

    /**
     * @var string
     */
    public $token_type;

    /***
     * @var \DateTime
     */
    public $expire;

    /**
     * @var string
     */
    public $clientId;

    /**
     * @var string
     */
    public $grantType;

    /**
     * @var string
     */
    public $clientSecret;

    /**
     * @var bool
     */
    public $preserve;

    /**
     * Class that originated the Token.
     * @var string class Name
     */
    public $from;

    public function store($clientId)
    {
        return file_put_contents(self::getFilePath($clientId), serialize($this));
    }

    /***
     * Returns the token if it's still active.
     * @param $clientId
     * @return Token|null
     */
    public static function restore($clientId)
    {
        $path = self::getFilePath($clientId);

        if (!file_exists($path)) {
            return null;
        }

        /**
         * @var Token $obj
         */
        $obj = unserialize(file_get_contents($path));

        if ($obj->preserve) {
            return $obj;
        }

        if (!$obj->expired()) {
            return $obj;
        }

        return null;
    }

    /**
     * If the token has already expired or not.
     * @return bool
     */
    public function expired()
    {
        return new \DateTime('now') > $this->expire;
    }

    /**
     * Restore the object.
     *
     * @param $clientId
     * @return string
     */
    protected static function getFilePath($clientId)
    {
        return sys_get_temp_dir().'/'. md5($clientId).'.ssd';
    }
}