<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ano extends Model
{
    protected $table = 'anos';

    protected $fillable = ['ano'];

    public function anoMes()
    {
        return $this->hasMany("App\AnoMes");
    }

}
