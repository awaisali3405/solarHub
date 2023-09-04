<?php

namespace App\Http\Repositories;

use App\Http\Repositories\BaseRepository\Repository;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use App\Models\DailyExpense;
use stdClass;

class DailyExpenseRepository extends Repository
{
    public function __construct()
    {
        $this->model = new DailyExpense();
    }

    public function get($id): DailyExpense
    {
        try {
            if ($id == 0) {
                $DailyExpense = $this->getModel();
                $DailyExpense->guard_name = '';
                return $DailyExpense;
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
            return DailyExpense::all();
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
