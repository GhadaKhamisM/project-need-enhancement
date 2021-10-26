<?php

namespace App\Services;

use \Exception;
use \Bosnadev\Repositories\Eloquent\Repository;
use \Illuminate\Database\Eloquent\Model;

abstract class BaseService
{
    protected $repository;

    public function setRepository($repository)
    {
        $this->repository = $repository;
    }

}