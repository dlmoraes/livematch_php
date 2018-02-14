<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $table = 'metas';

    protected $fillable = [
        'empresa_id',
        'distrital_id',
        'regional_id',
        'indicador_id',
        'unidade'
    ];

    protected $unidades = [
        1 => 'Pontos',
        2 => 'Qtde',
        3 => 'R$',
        4 => 'R$M',
        5 => 'R$MM',
        6 => '%'
    ];

    public function getUnidades()
    {
        return $this->unidades;
    }

    public function getChaveUnidades()
    {
        $array = $this->unidades;
        $key = array_search($this->unidade, $array);
        return $key;
    }

    public function getUnidade() {
        return $this->unidades[$this->unidade];
    }

    public function txtUnidade($unidade) {
        return $this->unidades[$unidade];
    }

    public function empresa()
    {
        return $this->belongsTo("App\Empresa", "empresa_id");
    }

    public function distrital()
    {
        return $this->belongsTo("App\Distrital", 'distrital_id');
    }

    public function regional()
    {
        return $this->belongsTo("App\Regional", 'regional_id');
    }

    public function indicador()
    {
        return $this->belongsTo("App\Indicador", 'indicador_id');
    }
}
