<?php
/**
 * Created by PhpStorm.
 * User: Marco
 * Date: 26/02/2016
 * Time: 10:10
 */

namespace MsiClient\Central\Commands\Properties;


class BranchProperties extends PropertiesAbstract
{

    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $phone;

    /**
     * @var string
     */
    public $birthday_date;

    /**
     * @var bool
     */
    public $owner;

    /**
     * @var string
     */
    public $created_at;

    /**
     * @var string
     */
    public $deleted_at;

    /**
     * @var integer
     */
    public $user_id;

    /**
     * @var integer
     */
    public $branch_id;

    /**
     * @var string
     */
    public $password;

    /**
     * @var bool
     */
    public $active;

    /**
     * @var bool
     */
    public $admin;

}