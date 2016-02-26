<?php
/**
 * Created by PhpStorm.
 * User: Marco
 * Date: 26/02/2016
 * Time: 10:18
 */

namespace MsiClient\Central\Commands;


use MsiClient\Central\Commands\Properties\BranchProperties;

class Branch extends Command
{


    public $url = "/branchs";


    public  function save(BranchProperties $branch) {

        $formatter = Formatter::create(\MsiClient\Client::Formart_Request);

        return $this->perform($formatter->encode($branch->toArray()), \MsiClient\Client::POST_REQUEST);
    }
}