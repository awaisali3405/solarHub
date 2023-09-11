<?php

namespace App\Http\Controllers\Front;

use App\Models\Admin;
use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function __construct()
    {
        View::composer('*', function ($view) {
            if(Auth::check()){
                $admin=Admin::where('city_id',auth()->user()->city_id)->first();
                // $product=collect();
                if($admin){

                 $product=$admin->products;
             }
            //  dd($admin->products);

         }else{
             $product = Product::where('status', 1)->get();

         }
            $view->with([
               'category'=>Category::where('status',1)->get(),
               'products'=>$product,
               'city'=>City::all()

                // 'role' => session()->get('ADMIN')['role'],
            ]);
        });
    }
}
