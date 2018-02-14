<?php

namespace App\Repositories\Eloquent;

use App\Empresa;
use App\Repositories\AbstractRepository;
use App\Repositories\DAO\EmpresaRepositoryInterface;

class EmpresaRepository extends AbstractRepository implements EmpresaRepositoryInterface
{
    public function __construct(Empresa $modelo)
    {
        $this->modelo = $modelo;
    }

    public function empresasSelect()
    {
        // TODO: Implement empresasSelect() method.
        return Empresa::orderBy('empresa')->pluck('empresa', 'id');
    }

}