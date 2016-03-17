<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 02/03/16
 * Time: 17:05
 */

namespace MsiClient\Whm\Commands\Properties;


class AccountProperties extends PropertiesAbstract implements PropertiesFactoryInterface
{

    public $username;



    public $domain;

    public $plan;

    public $pkgname;

    public $savepkg;

    public $featurelist;

    public $quota;

    public $password;

    public $ip;

    public $cgi;

    public $frontpage;

    public $hasshell;

    public $contactemail;

    public $cpmod;

    public $maxftp;

    public $maxsql;

    public $maxpop;

    public $maxsub;

    public $maxpark;

    public $maxaddon;

    public $bwlimit;

    public $customip;

    public $language;

    public $usergens;

    public $hasusergens;

    public $reseller;

    public $forcedns;

    public $mxcheck;

    public $MAX_EMAIL_PER_HOUR;

    public $MAX_DEFER_FAIL_PERCENTAGE;

    public $uid;

    public $gid;

    public $homedir;

    public $dkim;

    public $spf;

    public $owner;




    public static function create($array)
    {
        return self::factory($array, self::class);
    }


    /***
     * Campos usadios unicament edentro da requisição change
     */
    protected $user;
    protected $dns;

    public function transformTochange()
    {

        $this->user = $this->username;
        $this->dns = $this->domain;
    }

}