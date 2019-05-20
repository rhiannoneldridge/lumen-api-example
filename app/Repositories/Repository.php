<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;

use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    /** @var  \Illuminate\Database\Eloquent\Model */
    protected $model;

    /**
     * Repository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->setModel($model);
    }

    /**
     * @param Model $model
     * @return $this
     */
    public function setModel(Model $model)
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        return $this->model->get();
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection|Model|Model[]
     */
    public function get(int $id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }

    /**
     * @param array $ids
     * @return int
     */
    public function deleteMultiple(array $ids)
    {
        return $this->model->destroy($ids);
    }

    /**
     * @param array $params
     * @return Model
     */
    public function create(array $params)
    {
        return $this->model->create($params);
    }

    /**
     * @param array $params
     * @param int $id
     * @return bool
     */
    public function update(array $params, int $id)
    {
        return $this->model->findOrFail($id)->update($params);
    }

    /**
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Builder|Model
     */
    public function with(array $relations)
    {
        return $this->model->with($relations);
    }
}
