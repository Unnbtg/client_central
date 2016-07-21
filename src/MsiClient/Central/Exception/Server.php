<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 15/02/16
 * Time: 09:06
 */

namespace MsiClient\Central\Exception;

use Exception;

/***
 *
 * Exceptions related with the server communication usually indicates a error 500 of some kind.
 * Class Server
 * @package MsiClient\Central\Exception
 */
class Server extends \Exception
{

    public $request;

    public $parsedResponse;

    public $response;

    /**
     * @inheritDoc
     */
    public function __construct($message = "", $code = 0, $parsedResponse, $response, $request , Exception $previous = null)
    {

        $this->response = $response;
        $this->response = $request;
        $this->parsedResponse = $parsedResponse;



        parent::__construct($message, $code, $previous); // TODO: Change the autogenerated stub
    }


}