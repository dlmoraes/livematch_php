<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lancamento extends Model
{
    protected $table = 'metas_hist';

    protected $fillable = [
        'meta_id',
        'ano_id',
        'mes_id',
        'vlr_meta',
        'vlr_real'
    ];

    public function meta()
    {
        return $this->belongsTo("App\Meta", 'meta_id');
    }

    public function ano() {
        return $this->belongsTo('App\Ano', 'ano_id');
    }

    public function mes() {
        return $this->belongsTo('App\Mes', 'mes_id');
    }

//    public function referencia()
//    {
//        return $this->belongsTo("App\AnoMes", 'ano_mes_id');
//    }
}
