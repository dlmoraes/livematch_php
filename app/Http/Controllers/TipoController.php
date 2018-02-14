<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 04/02/2018
 * Time: 15:06
 */

namespace App\Http\Controllers;

use App\Repositories\DAO\TipoIndRepositoryInterface;
use Illuminate\Support\Facades\Input;
use Exception;
use Response;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;


class TipoController extends Controller
{

    private $repositorio;

    protected $regras =
        [
            'tipo' => 'required|min:5|max:50'
        ];

    public function __construct(TipoIndRepositoryInterface $tipoRepository)
    {
        $this->repositorio = $tipoRepository;
    }

    public function index(Request $request)
    {
        return view('admin.tipos.index', ['dados' => $this->repositorio->todos()]);
    }

    public function lists(Request $request) {
        return view('admin.tipos.table', ['dados' => $this->repositorio->todos()]);
    }

    public function tiposAjax(Request $request) {
        if ($request->ajax()) {
            $tipos = $this->repositorio->tipoindSelect();
            return response()->json($tipos);
        }
    }

    public function createAjax(Request $request) {
        if ($request->ajax()) {
            $validacao = Validator::make(Input::all(), $this->regras);
            if ($validacao->fails()) {
                error_log($validacao->getMessageBag());
                return Response::json(array('errors' => $validacao->getMessageBag()->toArray()));
            } else {
                error_log('Requisição Ajax recebida');
                $tipo = $this->repositorio->criar(Input::all());
                return response()->json($tipo);
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
                $tipo = $this->repositorio->atualizar($id, Input::all());
                return response()->json($tipo);
            }
        }
    }

    public function deleteAjax(Request $request, $id) {
        if ($request->ajax()) {
            if ($id) {
                $tipo = $this->repositorio->excluir($id);
                return response()->json($tipo);
            }
        }
    }
}