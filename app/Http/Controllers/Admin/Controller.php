<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\City;
use App\Models\SubCategory;
use App\Models\Unit;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $breadcrumbs, $pageTitle, $pageHeading;

    public function __construct()
    {
        View::composer('*', function ($view) {
            $view->with([
                'breadcrumbs' => $this->breadcrumbs,
                'pageTitle' => $this->pageTitle,
                'pageHeading' => $this->pageHeading,
                'category' => Category::where('status',1)->latest()->get(),
                'subCategory' => SubCategory::where('status',1)->latest()->get(),
                'unit' => Unit::where('status',1)->latest()->get(),
                'city'=>City::all()
                // 'role' => session()->get('ADMIN')['role'],
            ]);
        });
    }
}
