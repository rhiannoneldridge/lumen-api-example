<?php

namespace App\Repositories;

class UserRepository extends Repository
{
    /**
     * @param array $params
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $params)
    {
        if (array_key_exists('password', $params)) {
            $params['password'] = app('hash')->make($params['password']);
        }

        return parent::create($params);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        return $this->model->with('roles')->get();
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Model[]
     */
    public function get(int $id)
    {
        return $this->model->with('roles')->findOrFail($id);
    }

    /**
     * @param array $params
     * @param int $id
     * @return bool
     */
    public function update(array $params, int $id)
    {
        if (array_key_exists('password', $params)) {
            $params['password'] = app('hash')->make($params['password']);
        }

        return parent::update($params, $id);
    }

    /**
     * @param array $roleIds
     * @return void
     */
    public function assignRolesToUser(array $roleIds)
    {
        /** @var \App\Models\User $user */
        $user = $this->getModel();

        $user->roles()->syncWithoutDetaching($roleIds);
    }

    /**
     * @param array $roleIds
     * @return void
     */
    public function removeRolesFromUser(array $roleIds)
    {
        /** @var \App\Models\User $user */
        $user = $this->getModel();

        $user->roles()->detach($roleIds);
    }

    /**
     * @param int $roleId
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getRoleFromUser(int $roleId)
    {
        /** @var \App\Models\User $user */
        $user = $this->getModel();

        return $user->roles()->findOrFail($roleId);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Model[]
     */
    public function getRolesFromUser()
    {
        /** @var \App\Models\User $user */
        $user = $this->getModel();

        return $user->roles()->get();
    }
}