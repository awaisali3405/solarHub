<?php


namespace App\Http\Repositories\BaseRepository;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use Auth;
use Tymon\JWTAuth\JWTAuth;

class Repository
{
    protected $model;

    protected $relations = [];

    protected $fromWeb = false;

    protected $user;

    protected $paginate = 10;


    public function getQuery()
    {
        return $this->getModel()->query();
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setRelations($relations)
    {
        $this->relations = $relations;
    }

    public function getRelations()
    {
        return $this->relations;
    }

    public function setFromWeb($bool)
    {
        $this->fromWeb = $bool;
    }

    public function getFromWeb()
    {
        return $this->fromWeb;
    }

    public function setUser($fromSession=false)
    {

        if ($this->getFromWeb()) {
            if($fromSession){
                $user = session()->get('USER_DATA');
            }else{
                $user = auth()->user();
            }
        } else {
            $user = \request('jwt.user', new \stdClass());
        }
        
        
        if (!isset($user->id))
        {
            $user = null;
        }
        $this->user = $user;

    }

    public function getUser($fromSession=false)
    {
        $this->setUser($fromSession);
        return $this->user;
    }

    public function setPaginate($int)
    {
        $this->paginate = $int;
    }

    public function getPaginate()
    {
        return $this->paginate;
    }

    public function uploadImage($request)
    {
        return uploadImage($request);
    }

}