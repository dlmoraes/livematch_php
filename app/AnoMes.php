<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnoMes extends Model
{
    protected $table = 'ano_mes';

    protected $fillable = ['ano_id','mes_id'];

    public function ano()
    {
        return $this->belongsTo("App\Ano","ano_id");
    }

    public function mes()
    {
        return $this->belongsTo("App\Mes","mes_id");
    }

}
