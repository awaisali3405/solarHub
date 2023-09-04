<?php

namespace App\Http\Controllers\Admin;

use App\Charts\ExpensesChart;
use App\Charts\OrderChart;
use App\Http\Repositories\TestRepository;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private TestRepository $testRepository;

    public function __construct(TestRepository $testRepository)
    {
        parent::__construct();
        $this->testRepository = $testRepository;
        $this->pageTitle = 'Dashboard';
        $this->breadcrumbs[route('admin.dashboard')] = ['icon' => 'fa fa-fw fa-home', 'title' => 'Dashboard'];
    }

    public function index(ExpensesChart $expensesChart, OrderChart $orderChart)
    {
        $val = $this->testRepository->get(0);
        $sale = Sale::whereDate('created_at', Carbon::now())->get();
        $purchase = Purchase::whereDate('created_at', Carbon::now())->get();

        // dd($sale);
        $daily_sale = 0;
        foreach ($sale as $key => $value) {
            $daily_sale += $value->total;
        }
        $daily_purchase = 0;
        foreach ($purchase as $key => $value) {
            $daily_purchase += $value->total;
        }


        // // Get users grouped by age
        // $groups = $daily_sale;
        // // Generate random colours for the groups
        // for ($i = 0; $i <= count($groups); $i++) {
        //     $colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        // }
        // // Prepare the data for returning with the view
        // $chart = new Chart;
        // $chart->labels = (array_keys($groups));
        // $chart->dataset = (array_values($groups));
        // $chart->colours = $colours;
        return view('admin.dashboard', [
            'val' => $val,
            'daily_sales' => $daily_sale,
            'daily_purchase' => $daily_purchase,
            'supplier' => count(Supplier::all()),
            'customer' => count(Customer::all()),
            'product' => count(Product::where('category_id', 1)->get()),
            'chart' => $expensesChart->build(),
            'orderChart' => $orderChart->build()

        ]);
    }

    public function blankPage()
    {
        $this->breadcrumbs['javascript:{};'] = ['icon' => 'fa fa-fw fa-money', 'title' => 'Blank Page'];
        return view('admin.blank');
    }
}
