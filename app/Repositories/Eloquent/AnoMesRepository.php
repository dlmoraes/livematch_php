<?php

namespace App\Repositories\Eloquent;

use App\AnoMes;
use App\Repositories\AbstractRepository;
use App\Repositories\DAO\AnoMesRepositoryInterface;
use Illuminate\Support\Facades\DB;

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

    public function mesesPorAnoSelect($ano)
    {
        // TODO: Implement mesesPorAnoSelect() method.
        return AnoMes::select(DB::raw(
            '
            anos.ano,
            ano_mes.mes_id
            '
        ))->join('anos', 'ano_mes.ano_id', '=', 'anos.id')
          ->where('anos.ano', '=', $ano)
          ->get();
    }
}