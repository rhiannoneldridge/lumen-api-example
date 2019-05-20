<?php

namespace App\Repositories;

class UserRepository extends Repository
{
    public function create(array $params)
    {
        if (array_key_exists('password', $params)) {
            $params['password'] = app('hash')->make($params['password']);
        }

        return parent::create($params);
    }

    public function update(array $params, int $id)
    {
        if (array_key_exists('password', $params)) {
            $params['password'] = app('hash')->make($params['password']);
        }

        return parent::update($params, $id);
    }
}