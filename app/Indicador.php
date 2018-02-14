<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
    protected $table = 'indicadores';

    protected $fillable = [
        'ordem',
        'indicador',
        'categoria_id',
        'tipo_ind_id',
        'objetivo'
    ];

    public function categoria()
    {
        return $this->belongsTo("App\Categoria", "categoria_id", "id");
    }

    public  function tipo() {
        return $this->belongsTo("App\TipoInd", 'tipo_ind_id', "id");
    }
}
