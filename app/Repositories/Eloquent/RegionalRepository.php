<?php

namespace App\Repositories\Eloquent;

use App\Regional;
use App\Repositories\AbstractRepository;
use App\Repositories\DAO\RegionalRepositoryInterface;

class RegionalRepository extends AbstractRepository implements RegionalRepositoryInterface
{
    public function __construct(Regional $modelo)
    {
        $this->modelo = $modelo;
    }

    public function regionalSelect()
    {
        // TODO: Implement regionalSelect() method.
        return Regional::orderBy('regional')->pluck('regional', 'id');
    }


}