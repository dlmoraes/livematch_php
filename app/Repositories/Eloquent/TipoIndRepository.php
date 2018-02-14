<?php

namespace App\Repositories\Eloquent;

use App\TipoInd;
use App\Repositories\AbstractRepository;
use App\Repositories\DAO\TipoIndRepositoryInterface;

class TipoIndRepository extends AbstractRepository implements TipoIndRepositoryInterface
{
    public function __construct(TipoInd $modelo)
    {
        $this->modelo = $modelo;
    }

    public function tipoindSelect()
    {
        // TODO: Implement tipoindSelect() method.
        return TipoInd::orderBy('tipo')->pluck('tipo', 'id');
    }

}