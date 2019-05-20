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
        $this->getModel()->attach($roleIds);
    }

    /**
     * @param array $roleIds
     * @return void
     */
    public function removeRolesFromUser(array $roleIds)
    {
        $this->getModel()->detach($roleIds);
    }

    /**
     * @param int $roleId
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getRoleFromUser(int $roleId)
    {
        return $this->getModel()->roles()->findOrFail($roleId);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Model[]
     */
    public function getRolesFromUser()
    {
        return $this->getModel()->roles()->all();
    }
}