<?php
/**
 * Created by PhpStorm.
 * User: Marco
 * Date: 26/02/2016
 * Time: 10:18
 */

namespace MsiClient\Central\Commands;


use MsiClient\Central\Commands\Properties\BranchUserProperties;
use MsiClient\Central\Factory\Formatter;


class BranchUser extends Command
{
    public $url = "/branch-user";

    public function save(BranchUserProperties $branch)
    {
        $formatter = Formatter::create(\MsiClient\Client::Formart_Request);
        $retorno = $this->perform(
            ['data' => $formatter->encode(['branch-user' => $branch->toArray()])],
            \MsiClient\Client::POST_REQUEST
        );

        return $retorno;
    }

    public function show($id)
    {
        $retorno = $this->perform([], \MsiClient\Client::GET_REQUEST, $this->getUrl() . '/' . $id);
        $user = new BranchUserProperties();
        return $user->fromStdClass($retorno->data);
    }
}