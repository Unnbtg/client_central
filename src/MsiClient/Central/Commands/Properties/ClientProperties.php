<?php
/**
 * Created by PhpStorm.
 * User: Marco
 * Date: 23/02/2016
 * Time: 11:53
 */

namespace MsiClient\Central\Commands\Properties;


class ClientProperties extends PropertiesAbstract
{
    /**
     * @var integer
     */
    public $id;

    /**
     * Code of the client, like u99999
     * @var
     */
    public $code;

    /**
     *
     * @var string
     */
    public $state_registration;

    /**
     * 0 = Inactive
     * 1 = Active
     * @var integer
     */
    public $status;

    /**
     * @var string
     */
    public $obs;

    /**
     * @var integer
     */
    public $user_id;

    /***
     * User id of the seller
     * @var integer
     */
    public $vendor_id;

    /**
     *
     * @var integer
     */
    public $customer_id;

    /***
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $company_name;

    /***
     * @var string
     */
    public $cpf_cnpj;

    /**
     * @var string
     */
    public $ie;

    /**
     * @var string
     */
    public $rg;

    /**
     * @var string
     */
    public $cep;

    /**
     * @var string
     */
    public $address;

    /**
     * @var string
     */
    public $number;

    /**
     * @var string
     */
    public $complement;

    /**
     * @var string
     */
    public $neighborhood;

    /**
     * @var string
     */
    public $city;

    /**
     * @var string
     */
    public $uf;

    /**
     * @var integer
     */
    public $billing_day;

    /**
     * @var string
     */
    public $same_address;

    /**
     * @var string$clientId, $configName, $product_id, $value
     */
    public $billing_cep;

    /**
     * @var string
     */
    public $billing_address;

    /**
     * @var integer
     */
    public $billing_number;

    /**
     * @var string
     */
    public $billing_complement;

    /**
     * @var string
     */
    public $billing_neighborhood;

    /**
     * @var string
     */
    public $phone1;

    /**
     * @var string
     */
    public $phone2;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $disable_monthly;

    /**
     * @var string
     */
    public $billing_city;

    /**
     * @var string
     */
    public $billing_uf;

    public static $statusToText = [
        1 => 'ativo',
        2 => 'suspenso',
        3 => 'cancelado',
        4 => 'pré cliente'
    ];

    public function replicateAddress() {
        $this->billing_address = $this->address;
        $this->billing_cep = $this->cep;
        $this->billing_city = $this->city;
        $this->billing_complement = $this->complement;
        $this->billing_neighborhood = $this->neighborhood;
        $this->billing_number = $this->number;
        $this->billing_uf = $this->uf;
    }
}