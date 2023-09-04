<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\TestRepositoryInterface;
use App\Http\Repositories\BaseRepository\Repository;

class TestRepository extends Repository implements TestRepositoryInterface
{
    public function __construct()
    {
//        $this->model = new Test();
    }

    public function get($id): string
    {
        return "0ok";
    }

    public function all()
    {
        // TODO: Implement all() method.
    }

    public function save($data, $id)
    {
        // TODO: Implement save() method.
    }

    public function remove()
    {
        // TODO: Implement remove() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}
