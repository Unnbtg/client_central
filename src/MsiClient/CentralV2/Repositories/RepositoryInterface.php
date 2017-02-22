<?php
/**
 * Created by PhpStorm.
 * User: unamed
 * Date: 20/02/17
 * Time: 10:36
 */

namespace MsiClient\CentralV2\Repositories;


interface RepositoryInterface
{
    public function store($attribtues);

    public function update($identifier, $attributes);

    public function delete($identifier);

}