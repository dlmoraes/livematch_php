<?php
/**
 * Created by PhpStorm.
 * User: flavio
 * Date: 29/01/18
 * Time: 12:52
 */

namespace App\Repositories\DAO;


interface TipoIndRepositoryInterface extends RepositoryInterface
{
    public function tipoindSelect();
}