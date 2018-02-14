<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckSuperUser;
use App\RegistrarLog;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $usuarios = User::all();
        //$nomepq = getCurto($usuarios);
        return view('admin.usuarios.index', ['usuarios' => $usuarios]);
    }

    /*public function getCurto(Request $request) {
        $temp = explode(' ', $request->nome);
        $nomecurto = $temp[0] . ' ' . end($temp);
        return $nomecurto;
    }*/

    public function acessoUsuario(Request $request, $id)
    {
      $usuario = User::find($id);
      return view('auth.access', ['usuario' => $usuario]);
    }

    public function atualizarAcesso(Request $request, $id)
    {
      $usuario = User::find($id);
      $usuario->nivel  = $request->nivel;
      try {
        $usuario->save();
      } catch (Exception $e) {
          RegistrarLog::create([
              'user_id' => $usuario->id,
              'acao' => 'Erro ao tentar alterar o acesso do usuario.',
              'observacao' => $e->getCode() . ' - ' . $e->getMessage()
          ]);
      }
      return redirect('/home')->with('status', 'Dados de acesso, atualizados com sucesso!')->with('tipo', 'success');
    }

    public function prepararAlterarSenha(Request $request, $user_id=null) {
        $usuario = null;
        if ($request->user()->nivel==='admin') {
            if ($user_id == null) {
                $usuario = $request->user();
            } else {
                $usuario = User::find($user_id);
            }
        } else if($user_id != null) {
            return redirect('/')->with('status', 'Usuário sem privilégios!')->with('tipo', 'error');
        } else {
            $usuario = $request->user();
        }
        return view('auth.passwords.alterarsenha', compact('usuario'));
    }


    public function alterarSenha(Request $request, $user_id) {
        if ($request->user()->id != $user_id) {
          return redirect('/home')->with('status', 'Usuario logado e usuario informado nao correspondem!')->with('tipo', 'error');
        }
        try{
            $novaSenha = $request->password;
            $usuario = User::findOrFail($user_id);
            $novaSenha = bcrypt($novaSenha);
            $usuario->forceFill(['password' => $novaSenha])->save();
            RegistrarLog::create(['user_id' => $usuario->id, 'acao' => 'O usuario id= ' . $usuario->id . ', alterou sua senha.']);
        } catch (Exception $e) {
            RegistrarLog::create([
                'user_id' => $usuario->id,
                'acao' => 'Erro ao tentar alterar senha!',
                'observacao' => $e->getCode() . ' - ' . $e->getMessage()
            ]);
        }
        return redirect('/')->with('status', 'Senha alterada com sucesso!')->with('tipo', 'success');
    }

    public function prepararResetarSenha(Request $request, $user_id=null) {
        $usuario = null;
        if ($request->user()->nivel==='admin') {
            $usuario = User::find($user_id);
            return view('auth.passwords.resetarsenha', compact('usuario'));
        }
        return redirect('/home');
    }

    public function forcarSenhaPadrao(Request $request, $user_id) {
        try {
            $usuario = $request->user();
            $usuario_selecionado = User::findOrFail($user_id);
            $senhaPadrao = bcrypt('celpa@01');
            $usuario_selecionado->forceFill(['password' => $senhaPadrao])->save();
            RegistrarLog::create([
                'user_id' => $usuario->id,
                'acao' => 'O usuario id= ' . $usuario->id . ', resetou sua senha do usuario de login => ' . $usuario_selecionado->login
            ]);
        } catch (Exception $e) {
            RegistrarLog::create([
                'user_id' => $usuario->id,
                'acao' => 'Erro ao tentar resetar a senha do usuario' . $usuario_selecionado->login,
                'observacao' => $e->getCode() . ' - ' . $e->getMessage()
            ]);
        }
        return redirect('/home');
    }
}
