<?php

namespace App\Http\Controllers\Front;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function __construct()
    {
        View::composer('*', function ($view) {
            $view->with([
               'category'=>Category::where('status',1)->get(),
               'products'=>Product::where('status',1)->get(),
               
                // 'role' => session()->get('ADMIN')['role'],
            ]);
        });
    }
}
