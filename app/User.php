<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'nome', 'nivel', 'email', 'password', 'empresa_id'
    ];

    protected $niveis = [
        1 => 'Admin',
        2 => 'Consu',
        3 => 'Alter'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getNiveis() {
        return $this->niveis;
    }

    public function getChaveNiveis() {
        $array = $this->niveis;
        $key = array_search($this->nivel, $array);
        return $key;
    }

    public function getCurto(){
        $temp = $this->nome;
        $cNome = explode(' ', $temp);
        $rest = $cNome[0] . ' ' . end($cNome);
        return $rest;
    }

    public function getEmpresa(){
        $emp = $this->empresa->empresa;
        $cEmp = explode(' ', $emp);
        $rEmp = $cEmp[0];
        return $rEmp;
    }

    public function empresa()
    {
        return $this->belongsTo("App\Empresa", "empresa_id", "id");
    }

}
