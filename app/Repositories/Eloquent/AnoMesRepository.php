<?php

namespace App\Repositories\Eloquent;

use App\AnoMes;
use App\Repositories\AbstractRepository;
use App\Repositories\DAO\AnoMesRepositoryInterface;

class AnoMesRepository extends AbstractRepository implements AnoMesRepositoryInterface
{
    public function __construct(AnoMes $modelo)
    {
        $this->modelo = $modelo;
    }

    public function anoMesSelect()
    {
        // TODO: Implement anoMessSelect() method.
        return AnoMes::orderBy('ano_id','mes_id')->pluck('ano_id', 'id');
    }

}