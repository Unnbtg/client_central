<?php
/**
 * Created by PhpStorm.
 * User: Marco
 * Date: 26/02/2016
 * Time: 10:10
 */

namespace MsiClient\Central\Commands\Properties;


class ClientUserProperties extends PropertiesAbstract
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
     * @var BranchProperties
     */
    public $branch;

    public function __construct()
    {
        $this->branch = new BranchProperties();
    }
    /**
     * 1 = Admin
     * 2 = Financeiro
     * 3 = Usuario
     * @var integer
     */
    public $contact_type;

    public function fromStdClass($element)
    {
        parent::fromStdClass($element); // TODO: Change the autogenerated stub
        return $this;
    }


}