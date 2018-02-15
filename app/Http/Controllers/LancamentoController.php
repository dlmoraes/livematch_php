<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 04/02/2018
 * Time: 15:06
 */

namespace App\Http\Controllers;

use App\Lancamento;
use App\Meta;
use App\Repositories\DAO\AnoMesRepositoryInterface;
use App\Repositories\DAO\LancamentoRepositoryInterface;
use App\Repositories\DAO\MetaRepositoryInterface;
use Illuminate\Support\Facades\Input;
use Exception;
use Response;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;


class LancamentoController extends Controller
{

    private $repositorio;
    private $metaRepository;
    private $anoMesRepository;

    protected $regras =
        [
            'meta_id' => 'required',
            'ano_mes_id' => 'required',
            'vlr_meta' => 'required'
        ];

    public function __construct(LancamentoRepositoryInterface $lancamentoRepository,
                                MetaRepositoryInterface $metaRepository,
                                AnoMesRepositoryInterface $anoMesRepository)
    {
        $this->repositorio = $lancamentoRepository;
        $this->metaRepository = $metaRepository;
        $this->anoMesRepository = $anoMesRepository;
    }

    public function index(Request $request)
    {
        $metas = $this->metaRepository->metaSelect();
        $anoMes = $this->anoMesRepository->anoMesSelect();
        $meta = new Meta;
        return view('admin.lancamentos.index', [
            'dados' => $this->repositorio->lancamentosAdmin(),
            'metas' => $metas,
            'anoMes' => $anoMes,
            'meta' => $meta
            ]);
    }

    public function lists(Request $request) {
        return view('admin.lancamentos.table', ['dados' => $this->repositorio->todos()]);
    }

    public function createAjax(Request $request) {
        if ($request->ajax()) {
            $validacao = Validator::make(Input::all(), $this->regras);
            if ($validacao->fails()) {
                error_log($validacao->getMessageBag());
                return Response::json(array('errors' => $validacao->getMessageBag()->toArray()));
            } else {
                //error_log('Requisição Ajax recebida');
                $meta = $this->repositorio->criar(Input::all());
                return response()->json($meta);
            }
        }
    }

    public function editAjax(Request $request, $id) {
        if ($request->ajax()) {
            $validacao = Validator::make(Input::all(), $this->regras);
            if ($validacao->fails()) {
                error_log($validacao->getMessageBag());
                return Response::json(array('errors' => $validacao->getMessageBag()->toArray()));
            } else {
//                error_log('Requisição Ajax recebida');
                $meta = $this->repositorio->atualizar($id, Input::all());
                return response()->json($meta);
            }
        }
    }

    public function deleteAjax(Request $request, $id) {
        if ($request->ajax()) {
            if ($id) {
                $meta = $this->repositorio->excluir($id);
                return response()->json($meta);
            }
        }
    }

    public function metasAjax(Request $request) {
      if ($request->ajax()) {
        $metas = $this->repositorio->todos();
        return response()->json($metas);
      }
    }


}
