<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 04/02/2018
 * Time: 15:06
 */

namespace App\Http\Controllers;

use App\Meta;
use App\Repositories\DAO\DistritalRepositoryInterface;
use App\Repositories\DAO\EmpresaRepositoryInterface;
use App\Repositories\DAO\MetaRepositoryInterface;
use App\Repositories\DAO\IndicadorRepositoryInterface;
use App\Repositories\DAO\RegionalRepositoryInterface;
use Illuminate\Support\Facades\Input;
use Exception;
use Response;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;


class MetaController extends Controller
{

    private $repositorio;
    private $indicadorRepository;
    private $empresaRepository;
    private $regionalRepository;
    private $distritalRepository;

    protected $regras =
        [
            'empresa_id' => 'required',
            'unidade' => 'required',
            'indicador_id' => 'required'
        ];

    public function __construct(MetaRepositoryInterface $metaRepository,
                                IndicadorRepositoryInterface $indicadorRepository,
                                EmpresaRepositoryInterface $empresaRepository,
                                RegionalRepositoryInterface $regionalRepository,
                                DistritalRepositoryInterface $distritalRepository)
    {
        $this->repositorio = $metaRepository;
        $this->indicadorRepository = $indicadorRepository;
        $this->empresaRepository = $empresaRepository;
        $this->regionalRepository = $regionalRepository;
        $this->distritalRepository = $distritalRepository;
    }

    public function index(Request $request)
    {
        $indicadores = $this->indicadorRepository->indicadorSelect();
        $empresas = $this->empresaRepository->empresasSelect();
        $regionais = $this->regionalRepository->regionalSelect();
        $distritais = $this->distritalRepository->distritalsSelect();
        $meta = new Meta;
        $unidades = $meta->getUnidades();
        return view('admin.metas.index', [
            'dados' => $this->repositorio->todos(),
            'indicadores' => $indicadores,
            'empresas' => $empresas,
            'regionais' => $regionais,
            'distritais' => $distritais,
            'unidades' => $unidades
            ]);
    }

    public function lists(Request $request) {
        return view('admin.metas.table', ['dados' => $this->repositorio->todos()]);
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
