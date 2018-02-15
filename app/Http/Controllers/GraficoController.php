<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 04/02/2018
 * Time: 15:06
 */

namespace App\Http\Controllers;

use App\Repositories\DAO\AnoMesRepositoryInterface;
use App\Repositories\DAO\AnoRepositoryInterface;
use App\Repositories\DAO\IndicadorRepositoryInterface;
use App\Repositories\DAO\LancamentoRepositoryInterface;
use App\Repositories\DAO\MesRepositoryInterface;
use Illuminate\Support\Facades\Input;
use Exception;
use Response;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;


class GraficoController extends Controller
{

    private $indicadorRepositorio;
    private $lancamentoRepositorio;
    private $anoRepositorio;
    private $mesRepositorio;
    private $referenciaRepositorio;

    protected $regras =
        [
            'ordem' => 'required',
            'indicador' => 'required|min:2|max:50',
            'categoria_id' => 'required',
            'tipo_ind_id' => 'required'
        ];

    public function __construct(IndicadorRepositoryInterface $indicadorRepository,
                                AnoRepositoryInterface $anoRepository,
                                MesRepositoryInterface $mesRepository,
                                AnoMesRepositoryInterface $referenciaRepository,
                                LancamentoRepositoryInterface $lancamentoRepository)
    {
        $this->indicadorRepositorio = $indicadorRepository;
        $this->lancamentoRepositorio = $lancamentoRepository;
        $this->anoRepositorio = $anoRepository;
        $this->mesRepositorio = $mesRepository;
        $this->referenciaRepositorio = $referenciaRepository;
    }

    public function indicadorTemplate(Request $request, $id) {
        $indicador = $this->indicadorRepositorio->porId($id);
        $anos = $this->anoRepositorio->anosSelect();
        return view('apps.indicador', compact('indicador', 'anos'));
    }

    public function lancamentosPorIndicadorAno(Request $request, $indicador, $ano) {
        if ($request->ajax()) {
            $lancamentos = $this->lancamentoRepositorio->lancamentosPorIndicador($indicador, $ano);
            return response()->json($lancamentos);
        }
    }
}
