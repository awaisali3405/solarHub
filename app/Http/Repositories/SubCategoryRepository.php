<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\SubCategoryRepositoryInterface;
use App\Http\Repositories\BaseRepository\Repository;
use App\Models\SubCategory;
use Exception;

use stdClass;

class SubCategoryRepository extends Repository
{
    public function __construct()
    {
        $this->model = new SubCategory();
    }

    public function get($id): SubCategory
    {
        try {
            if ($id == 0) {
                $SubCategory = $this->getModel();
                $SubCategory->guard_name = '';
                return $SubCategory;
            } else {
                return $this->getModel()->findOrFail($id);
            }
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function all()
    {
        try {
            return SubCategory::all();
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function save($data, $id)
    {
        try {
            return $this->getModel()->updateOrCreate(['id' => $id], $data);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function remove()
    {
        // TODO: Implement remove() method.
    }

    public function destroy($id): bool
    {
        try {
            $this->get($id)->delete();
            return true;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

}
