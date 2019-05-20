<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;

use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    /** @var  \Illuminate\Database\Eloquent\Model */
    protected $model;

    public function __construct(Model $model)
    {
        $this->setModel($model);
    }

    public function setModel(Model $model)
    {
        $this->model = $model;
        return $this;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function get(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }

    public function deleteMultiple(array $ids)
    {
        return $this->model->destroy($ids);
    }

    public function create(array $params)
    {
        return $this->model->create($params);
    }

    public function update(array $params, int $id)
    {
        return $this->model->findOrFail($id)->update($params);
    }
}
