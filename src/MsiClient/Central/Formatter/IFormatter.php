<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 16/02/16
 * Time: 17:43
 */

namespace MsiClient\Central\Formatter;

/***
 * Interface IFormatter
 * Defines the basic functions of any Formatter
 * @package MsiClient\Central\Formatter
 */
interface IFormatter
{

    /***
     * Returns the mime-type of the file correspondent with this Format
     * @return string
     */
    public function getMimeType();

    /***
     * Transform any string with the proper format into an array.
     * @param string $value
     * @return array
     */
    public function decode($value);


    /**
     * Transform any object into a string into a string for the format
     * @param mixed $value
     * @return string mixed
     */
    public function encode($value);

}