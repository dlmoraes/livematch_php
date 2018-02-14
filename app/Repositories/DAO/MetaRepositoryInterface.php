<?php
/**
 * Created by PhpStorm.
 * User: flavio
 * Date: 29/01/18
 * Time: 12:52
 */

namespace App\Repositories\DAO;


interface MetaRepositoryInterface extends RepositoryInterface
{
    public function metaSelect();
}