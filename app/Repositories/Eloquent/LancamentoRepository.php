<?php

namespace App\Repositories\Eloquent;
	
use App\Lancamento;
use App\Repositories\AbstractRepository;
use App\Repositories\DAO\LancamentoRepositoryInterface;
use Illuminate\Support\Facades\DB;

class LancamentoRepository extends AbstractRepository implements LancamentoRepositoryInterface
{
    public function __construct(Lancamento $modelo)
    {
        $this->modelo = $modelo;
    }

    public function lancamentosAdmin()
    {
        // TODO: Implement lacamentosAdmin() method.
        return Lancamento::select(DB::raw(
            '
            metas_hist.id,
            metas_hist.meta_id,
            anos.ano,
            meses.mes,
            metas_hist.vlr_meta,
            metas_hist.vlr_real,
            metas_hist.ano_id,
            metas_hist.mes_id,
            indicadores.indicador,
            empresas.empresa,   
            regionals.regional,
            distritals.distrital,
            metas.unidade         
            '
        ))->leftJoin('metas', 'metas_hist.meta_id', '=', 'metas.id')
          ->leftJoin('indicadores', 'metas.indicador_id', '=', 'indicadores.id')
          ->leftJoin('empresas', 'metas.empresa_id', '=', 'empresas.id')
          ->leftJoin('regionals', 'metas.regional_id', '=', 'regionals.id')
          ->leftJoin('distritals', 'metas.distrital_id', '=', 'distritals.id')
//          ->leftJoin('ano_mes', 'metas_hist.ano_mes_id', '=', 'ano_mes.id')
          ->leftJoin('anos', 'metas_hist.ano_id', '=', 'anos.id')
          ->leftJoin('meses', 'metas_hist.mes_id', '=', 'meses.id')
          ->get();
    }

    public function lancamentosPorIndicador($indicador, $ano)
    {
        // TODO: Implement lancamentosPorIndicador() method.
        return Lancamento::select(DB::raw(
            '
            metas_hist.vlr_meta,
            metas_hist.vlr_real
            '
        ))->leftJoin('metas', 'metas_hist.meta_id', '=', 'metas.id')
          ->leftJoin('indicadores', 'metas.indicador_id', '=', 'indicadores.id')
          ->leftJoin('anos', 'metas_hist.ano_id', '=', 'anos.id')
          ->leftJoin('meses', 'metas_hist.mes_id', '=', 'meses.id')
          ->where('metas.indicador_id', '=', $indicador)
          ->where('anos.id', '=', $ano)
          ->orderBy('meses.mes', 'asc')
          ->get();
    }
}