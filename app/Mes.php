<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mes extends Model
{
    protected $table = 'meses';

    protected $fillable = ['mes','mes_texto'];

    public function anoMes()
    {
        return $this->hasMany("App\AnoMes");
    }

}
