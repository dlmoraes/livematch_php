<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 04/02/2018
 * Time: 15:06
 */

namespace App\Http\Controllers;

use App\Repositories\DAO\CategoriaRepositoryInterface;
use Illuminate\Support\Facades\Input;
use Exception;
use Response;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;


class CategoriaController extends Controller
{

    private $repositorio;

    protected $regras =
        [
            'categoria' => 'required|min:2|max:50'
        ];

    public function __construct(CategoriaRepositoryInterface $categoriaRepository)
    {
        $this->repositorio = $categoriaRepository;
    }

    public function index(Request $request)
    {
        return view('admin.categorias.index', ['dados' => $this->repositorio->todos()]);
    }

    public function lists(Request $request) {
        return view('admin.categorias.table', ['dados' => $this->repositorio->todos()]);
    }

    public function categoriasAjax(Request $request) {
      if ($request->ajax()) {
        $categorias = $this->repositorio->categoriasSelect();
        return response()->json($categorias);
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
                $categoria = $this->repositorio->criar(Input::all());
                return response()->json($categoria);
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
                $categoria = $this->repositorio->atualizar($id, Input::all());
                return response()->json($categoria);
            }
        }
    }

    public function deleteAjax(Request $request, $id) {
        if ($request->ajax()) {
            if ($id) {
                $categoria = $this->repositorio->excluir($id);
                return response()->json($categoria);
            }
        }
    }
}
