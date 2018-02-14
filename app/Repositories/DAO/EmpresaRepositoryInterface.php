<?php
/**
 * Created by PhpStorm.
 * User: dlmoraes
 * Date: 18/10/16
 * Time: 12:52
 */

namespace App\Repositories\DAO;


interface EmpresaRepositoryInterface extends RepositoryInterface
{
    public function empresasSelect();
}