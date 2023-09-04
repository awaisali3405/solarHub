<?php

namespace App\Http\Repositories;

use App\Http\Repositories\BaseRepository\Repository;
use App\Models\Sale;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

use stdClass;

class SaleRepository extends Repository
{
    public function __construct()
    {
        $this->model = new Sale();
    }

    public function get($id): Sale
    {
        try {
            if ($id == 0) {
                $Sale = $this->getModel();
                $Sale->guard_name = '';
                return $Sale;
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
            return Sale::all();
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function save($data, $id)
    {
        // dd($data);
        try {
            return $this->getModel()->updateOrCreate(['id' => $id], $data);
        } catch (Exception $exception) {
            return throw new Exception($exception->getMessage());
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