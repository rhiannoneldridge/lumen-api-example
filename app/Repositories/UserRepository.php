<?php

namespace App\Repositories;

class UserRepository extends Repository
{
    /**
     * @param array $params
     * @return Repository|\Illuminate\Database\Eloquent\Model
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
     * @param int $id
     * @return UserRepository|UserRepository[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function assignRolesToUser(array $roleIds, int $id)
    {
        $user = $this->get($id);

        $user->getModel()->attach($roleIds);

        return $user;
    }

    /**
     * @param array $roleIds
     * @param int $id
     * @return UserRepository|UserRepository[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function removeRolesFromUser(array $roleIds, int $id)
    {
        $user = $this->get($id);

        $user->getModel()->detach($roleIds);

        return $user;
    }
}