<?php

namespace App\Repositories\Eloquent;

use App\Mes;
use App\Repositories\AbstractRepository;
use App\Repositories\DAO\MesRepositoryInterface;

class MesRepository extends AbstractRepository implements MesRepositoryInterface
{
    public function __construct(Mes $modelo)
    {
        $this->modelo = $modelo;
    }

    public function mesesSelect()
    {
        // TODO: Implement mesesSelect() method.
        return Mes::orderBy('mes')->pluck('mes', 'id');
    }

}