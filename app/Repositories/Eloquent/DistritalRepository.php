<?php

namespace App\Repositories\Eloquent;

use App\Distrital;
use App\Repositories\AbstractRepository;
use App\Repositories\DAO\DistritalRepositoryInterface;

class DistritalRepository extends AbstractRepository implements DistritalRepositoryInterface
{
    public function __construct(Distrital $modelo)
    {
        $this->modelo = $modelo;
    }

    public function distritalsSelect()
    {
        // TODO: Implement distritalsSelect() method.
        return Distrital::orderBy('distrital')->pluck('distrital', 'id');
    }

}