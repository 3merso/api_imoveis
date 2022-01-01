<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function selectFilter($filters)
    {
        $this->model = $this->model->selectRaw($filters);
    }

    public function selectCondition($condition)
    {
        $expressions = explode(';', $condition);
//var_dump($expressions);die();
        foreach ($expressions as $e) {
            $exp = explode(':', $e);
            $this->model = $this->model->where($exp[0], $exp[1], $exp[2]);
        }
    }

    public function getResult()
    {
        return $this->model;
    }
}
