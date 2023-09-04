<?php

namespace App\Http\Repositories;

use App\Http\Repositories\BaseRepository\Repository;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use App\Models\Contract;
use stdClass;

class ContractRepository extends Repository
{
    public function __construct()
    {
        $this->model = new Contract();
    }

    public function get($id): Contract
    {
        try {
            if ($id == 0) {
                $Contract = $this->getModel();
                $Contract->guard_name = '';
                return $Contract;
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
            return Contract::all();
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function show($id)
    {
        try {
            return Contract::where('employee_id', $id)->get();
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
    public function save($data, $id)
    {
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
