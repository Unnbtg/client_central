<?php
/**
 * Created by PhpStorm.
 * User: Marco
 * Date: 23/02/2016
 * Time: 11:53
 */

namespace MsiClient\Central\Commands\Properties;


class ClientProperties
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
     * 0 = Inactive
     * 1 = Active
     * @var integer
     */
    public $status;

    /**
     * Date of the next billing date
     * @var Date
     */
    public $billing_date;

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


    public static $statusToText = [
        1 => 'ativo',
        2 => 'suspenso',
        3 => 'cancelado',
        4 => 'pré cliente'
    ];

    public function toArray() {
        $retorno = [];
        foreach ($this as $key => $property) {
            $retorno[$key] = $property;
        }

        return $retorno;
    }


}