<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\RolesRepositoryInterface;
use App\Http\Repositories\BaseRepository\Repository;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Spatie\Permission\Models\Role;
use stdClass;

class RolesRepository extends Repository implements RolesRepositoryInterface
{
    public function __construct()
    {
        $this->model = new Role();
    }

    public function get($id)
    {
        if($id == 0){
            $role = $this->getModel();
            $role->guard_name = '';
            return $role;
        } else {
            return $this->getModel()->with('permissions')->findOrFail($id);
        }
    }

    public function all()
    {
        try{
            return Role::all();
        } catch (Exception $exception){
            throw new Exception($exception->getMessage());
        }
    }

    public function save($data, $id)
    {
        try{
            $roleData['name'] = $data['name'];
            $roleData['guard_name'] = $data['guard_name'];
            $role = $this->getModel()->updateOrCreate(['id' => $id], $roleData);
            return $role->permissions()->sync($data['permissions']);
        } catch (Exception $exception){
            return throw new Exception($exception->getMessage());
        }
    }

    public function remove()
    {
        // TODO: Implement remove() method.
    }

    public function destroy($id)
    {
        try {
            $this->get($id)->delete();
            return true;
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
