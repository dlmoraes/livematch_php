<?php

namespace App\Repositories;

use App\Repositories\DAO\RepositoryInterface;

abstract class AbstractRepository implements RepositoryInterface
{

    protected $modelo;

    public function todos()
    {
        // TODO: Implement todos() method.
        return $this->modelo->all();
    }

    public function porId($id)
    {
        // TODO: Implement porId() method.
        return $this->modelo->find($id);
    }

    public function criar(array $dados)
    {
        // TODO: Implement criar() method.
        return $this->modelo->create($dados);
    }

    public function atualizar($id, array $dados)
    {
        // TODO: Implement atualizar() method.
        $modelo_atual = $this->modelo->find($id);
        $modelo_atual->fill($dados);
        if (!$modelo_atual->save()) {
            return false;
        }
        return $modelo_atual;
    }

    public function excluir($id)
    {
        // TODO: Implement excluir() method.
        return $this->modelo->find($id)->delete();
    }


}