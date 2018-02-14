<?php

namespace App\Repositories\Eloquent;
	
use App\Meta;
use App\Repositories\AbstractRepository;
use App\Repositories\DAO\MetaRepositoryInterface;
use Illuminate\Support\Facades\DB;

class MetaRepository extends AbstractRepository implements MetaRepositoryInterface
{
    public function __construct(Meta $modelo)
    {
        $this->modelo = $modelo;
    }

    public function metaSelect()
    {
        // TODO: Implement metaSelect() method.
        return Meta::orderBy('indicador')->pluck('indicador', 'id');
    }
}