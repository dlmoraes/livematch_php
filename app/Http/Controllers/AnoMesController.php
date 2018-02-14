<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 04/02/2018
 * Time: 15:06
 */

namespace App\Http\Controllers;

use App\Repositories\DAO\AnoRepositoryInterface;
use App\Repositories\DAO\MesRepositoryInterface;
use App\Repositories\DAO\AnoMesRepositoryInterface;
use Illuminate\Support\Facades\Input;
use Exception;
use Response;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;


class AnoMesController extends Controller
{

    private $repositorio;
    private $anoRepository;
    private $mesRepository;

    protected $regras =
        [
            'ano_id' => 'required',
            'mes_id' => 'required'
        ];

    public function __construct(AnoMesRepositoryInterface $anomesRepository,
                                AnoRepositoryInterface $anoRepository,
                                MesRepositoryInterface $mesRepository)
    {
        $this->repositorio = $anomesRepository;
        $this->anoRepository = $anoRepository;
        $this->mesRepository = $mesRepository;
    }

    public function index(Request $request)
    {
        $anos = $this->anoRepository->anosSelect();
        $meses = $this->mesRepository->mesesSelect();
        return view('admin.anomes.index', [
            'dados' => $this->repositorio->todos(),
            'anos' => $anos,
            'meses' => $meses
            ]);
    }

    public function lists(Request $request) {
        return view('admin.anomes.table', ['dados' => $this->repositorio->todos()]);
    }

    public function createAjax(Request $request) {
        if ($request->ajax()) {
            $validacao = Validator::make(Input::all(), $this->regras);
            if ($validacao->fails()) {
                error_log($validacao->getMessageBag());
                return Response::json(array('errors' => $validacao->getMessageBag()->toArray()));
            } else {
                error_log('Requisição Ajax recebida');
                $anomes = $this->repositorio->criar(Input::all());
                return response()->json($anomes);
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
                error_log('Requisição Ajax recebida');
                $anomes = $this->repositorio->atualizar($id, Input::all());
                return response()->json($anomes);
            }
        }
    }

    public function deleteAjax(Request $request, $id) {
        if ($request->ajax()) {
            if ($id) {
                $anomes = $this->repositorio->excluir($id);
                return response()->json($anomes);
            }
        }
    }

    public function anomesAjax(Request $request) {
      if ($request->ajax()) {
        $anomes = $this->repositorio->todos();
        return response()->json($anomes);
      }
    }
}
