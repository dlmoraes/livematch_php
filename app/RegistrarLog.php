<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrarLog extends Model
{
    protected $table = 'logs';

    protected $fillable = ['user_id', 'acao', 'observacao'];
}
