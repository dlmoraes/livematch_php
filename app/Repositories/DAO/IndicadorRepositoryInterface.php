<?php
/**
 * Created by PhpStorm.
 * User: dlmoraes
 * Date: 18/10/16
 * Time: 16:07
 */

namespace App\Repositories\DAO;


interface IndicadorRepositoryInterface extends RepositoryInterface
{
    public function indicadorSelect();
}