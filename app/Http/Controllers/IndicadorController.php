<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 04/02/2018
 * Time: 15:06
 */

namespace App\Http\Controllers;

use App\Repositories\DAO\CategoriaRepositoryInterface;
use App\Repositories\DAO\IndicadorRepositoryInterface;
use App\Repositories\DAO\TipoIndRepositoryInterface;
use Illuminate\Support\Facades\Input;
use Exception;
use Response;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;


class IndicadorController extends Controller
{

    private $repositorio;
    private $categoriaRepository;
    private $tipoRepository;

    protected $regras =
        [
            'ordem' => 'required',
            'indicador' => 'required|min:2|max:50',
            'categoria_id' => 'required',
            'tipo_ind_id' => 'required'
        ];

    public function __construct(IndicadorRepositoryInterface $indicadorRepository,
                                CategoriaRepositoryInterface $categoriaRepository,
                                TipoIndRepositoryInterface $tipoRepository)
    {
        $this->repositorio = $indicadorRepository;
        $this->categoriaRepository = $categoriaRepository;
        $this->tipoRepository = $tipoRepository;
    }

    public function index(Request $request)
    {
        $categorias = $this->categoriaRepository->categoriasSelect();
        $tipos = $this->tipoRepository->tipoindSelect();
        return view('admin.indicadores.index', [
            'dados' => $this->repositorio->todos(),
            'categorias' => $categorias,
            'tipos' => $tipos
            ]);
    }

    public function lists(Request $request) {
        return view('admin.indicadores.table', ['dados' => $this->repositorio->todos()]);
    }

    public function createAjax(Request $request) {
        if ($request->ajax()) {
            $validacao = Validator::make(Input::all(), $this->regras);
            if ($validacao->fails()) {
                error_log($validacao->getMessageBag());
                return Response::json(array('errors' => $validacao->getMessageBag()->toArray()));
            } else {
                error_log('Requisição Ajax recebida');
                $indicador = $this->repositorio->criar(Input::all());
                return response()->json($indicador);
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
                $indicador = $this->repositorio->atualizar($id, Input::all());
                return response()->json($indicador);
            }
        }
    }

    public function deleteAjax(Request $request, $id) {
        if ($request->ajax()) {
            if ($id) {
                $indicador = $this->repositorio->excluir($id);
                return response()->json($indicador);
            }
        }
    }

    public function indicadoresAjax(Request $request) {
      if ($request->ajax()) {
        $indicadores = $this->repositorio->todos();
        return response()->json($indicadores);
      }
    }
}
