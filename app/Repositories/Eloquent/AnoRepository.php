<?php

namespace App\Repositories\Eloquent;
	
use App\Ano;
use App\Repositories\AbstractRepository;
use App\Repositories\DAO\AnoRepositoryInterface;

class AnoRepository extends AbstractRepository implements AnoRepositoryInterface
{
    public function __construct(Ano $modelo)
    {
        $this->modelo = $modelo;
    }

    public function anosSelect()
    {
        // TODO: Implement anosSelect() method.
        return Ano::orderBy('ano')->pluck('ano', 'id');
    }

}