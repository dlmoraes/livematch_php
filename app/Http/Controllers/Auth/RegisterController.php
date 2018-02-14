<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Repositories\DAO\EmpresaRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Http\Requests;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    private $empresaRepositorio;
   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EmpresaRepositoryInterface $empresaRepositorio)
    {
        $this->empresaRepositorio = $empresaRepositorio;
        //$this->middleware('guest');
    }

    public function showRegistrationForm(Request $request)
    {
        $empresas = $this->empresaRepositorio->empresasSelect();
        $user_n = new User;
        $nivel = $user_n->getNiveis();
        return view('auth.register', compact('empresas','nivel'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'login' => 'required|string|max:255',
            'nome' => 'required|string|max:255',
            'nivel' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'empresa_id' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'login' => $data['login'],
            'nome' => $data['nome'],
            'nivel' => $data['nivel'],
            'empresa_id' => $data['empresa_id'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        //return User::create($data);
    }
}
