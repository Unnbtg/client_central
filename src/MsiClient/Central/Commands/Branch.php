<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 29/03/16
 * Time: 11:59
 */

namespace MsiClient\Central\Commands;

use MsiClient\Central\Commands\Properties\BranchProperties;
use MsiClient\Central\Factory\Formatter;


class Branch extends Command
{

    public $url = "/branch";

    public function save(BranchProperties $branch)
    {
        try {
            $formatter = Formatter::create(\MsiClient\Client::Formart_Request);

            $retorno = $this->perform(
                ['data' => $formatter->encode(['branch' => $branch->toArray()])],
                \MsiClient\Client::POST_REQUEST
            );

            return $branch->fromStdClass($retorno->branch);

        } catch (\Exception $e) {
            throw  $e;
        }
    }

    public function getByClientId($id)
    {
        try {
            $retorno = $this->perform([], \MsiClient\Client::GET_REQUEST, $this->getUrl() . '/by-client/' . $id);
            return $retorno->branch;
        } catch (\Exception $e) {
            throw  $e;
        }
    }

    public function find($id)
    {
        try {
            $retorno = $this->perform([], \MsiClient\Client::GET_REQUEST, $this->getUrl() . '/' . $id);
            $branch = new BranchProperties();
            return $branch->fromStdClass($retorno->branch);

        } catch (\Exception $e) {
            throw  $e;
        }
    }

    public function delete($id)
    {
        try {
            return $this->perform([], \MsiClient\Client::DELETE_REQUEST, $this->getUrl() . '/' . $id);
        } catch (\Exception $e) {
            throw  $e;
        }
    }
}