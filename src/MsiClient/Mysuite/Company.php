<?php

namespace MsiClient\Mysuite;

use MsiClient\Central\Factory\Formatter;
use MsiClient\Client;

/**
*
*/
class Company extends Command
{
    public function get($code)
    {
        $url = $this->getUrl('ws_getclientes.php');
        return $this->makeRequest($url, 'POST', ['codempresa' => $code], true);
    }
}
