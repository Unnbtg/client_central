<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 29/03/16
 * Time: 11:59
 */

namespace MsiClient\Central\Commands\Properties;


/**
 * Class BranchProperties
 * @package MsiClient\Central\Commands\Properties
 *
 * @property int $id
 * @property string $name
 * @property int $filial Old  Indentification of the SCI Desktop
 * @property string $cep
 * @property string $address
 * @property string $number
 * @property string $complement
 * @property string $neighborhood
 * @property string $city
 * @property string $uf
 * @property int    $status
 * @property string $obs
 * @property int    $client_id
 */

class BranchProperties extends PropertiesAbstract
{
    public  $id;
    public  $name;
    public  $filial;
    public  $cep;
    public  $address;
    public  $number;
    public  $complement;
    public  $neighborhood;
    public  $city;
    public  $uf;
    public  $status;
    public  $obs;
    public  $client_id;
}