<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 04/02/2018
 * Time: 15:06
 */

namespace App\Http\Controllers;

use App\Repositories\DAO\RegionalRepositoryInterface;
use Illuminate\Support\Facades\Input;
use Exception;
use Response;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;


class RegionalController extends Controller
{

    private $repositorio;

    protected $regras =
        [
            'regional' => 'required|min:2|max:50'
        ];

    public function __construct(RegionalRepositoryInterface $regionalRepository)
    {
        $this->repositorio = $regionalRepository;
    }

    public function index(Request $request)
    {
        return view('admin.regionais.index', ['dados' => $this->repositorio->todos()]);
    }

    public function lists(Request $request) {
        return view('admin.regionais.table', ['dados' => $this->repositorio->todos()]);
    }

    public function createAjax(Request $request) {
        if ($request->ajax()) {
            $validacao = Validator::make(Input::all(), $this->regras);
            if ($validacao->fails()) {
                error_log($validacao->getMessageBag());
                return Response::json(array('errors' => $validacao->getMessageBag()->toArray()));
            } else {
                error_log('Requisição Ajax recebida');
                $regional = $this->repositorio->criar(Input::all());
                return response()->json($regional);
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
                $regional = $this->repositorio->atualizar($id, Input::all());
                return response()->json($regional);
            }
        }
    }

    public function deleteAjax(Request $request, $id) {
        if ($request->ajax()) {
            if ($id) {
                $regional = $this->repositorio->excluir($id);
                return response()->json($regional);
            }
        }
    }
}