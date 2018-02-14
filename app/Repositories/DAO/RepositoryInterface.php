<?php

namespace App\Repositories\DAO;

interface RepositoryInterface
{

    public function todos();

    public function porId($id);

    public function criar(array $dados);

    public function atualizar($id, array $dados);

    public function excluir($id);

}