<?php

namespace App\Interfaces;

interface RepositoryInterface
{
    public function all();

    public function create(array $params);

    public function update(array $params, int $id);

    public function delete(int $id);

    public function deleteMultiple(array $ids);

    public function get(int $id);
}