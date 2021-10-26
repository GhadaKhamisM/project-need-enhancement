<?php

namespace App\Repositories;

abstract class BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model();
    }

    public abstract function model();

    public function findBy(string $column, string $value){
        return $this->model->where($column,$value)->first();
    }

    public function updateOrCreate($attr, $value)
    {
        return $this->model->updateOrCreate($attr, $value);
    }

    public function create(Array $data){
        return $this->model->create($data);
    }
    
}