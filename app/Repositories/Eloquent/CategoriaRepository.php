<?php

namespace App\Repositories\Eloquent;

use App\Categoria;
use App\Repositories\AbstractRepository;
use App\Repositories\DAO\CategoriaRepositoryInterface;

class CategoriaRepository extends AbstractRepository implements CategoriaRepositoryInterface
{
    public function __construct(Categoria $modelo)
    {
        $this->modelo = $modelo;
    }

    public function categoriasSelect()
    {
        // TODO: Implement categoriasSelect() method.
        return Categoria::orderBy('categoria')->pluck('categoria', 'id');
    }

}