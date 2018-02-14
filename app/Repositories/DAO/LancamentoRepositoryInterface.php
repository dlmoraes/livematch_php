<?php
/**
 * Created by PhpStorm.
 * User: flavio
 * Date: 29/01/18
 * Time: 12:52
 */

namespace App\Repositories\DAO;


interface LancamentoRepositoryInterface extends RepositoryInterface
{
    public function lancamentosAdmin();
    public function lancamentosPorIndicador($indicador, $ano);
}