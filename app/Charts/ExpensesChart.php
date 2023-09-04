<?php

namespace App\Charts;

use App\Models\DailyExpense;
use App\Models\Purchase;
use App\Models\Sale;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class ExpensesChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $purchase = Purchase::select('id', 'total', 'created_at')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('m');
            });
        $sale = Sale::select('id', 'total', 'created_at')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('m');
            });
        $daily_expense = DailyExpense::select('id', 'amount', 'created_at')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('m');
            });
        // dd($purchase);
        $expense_p = [];
        foreach ($daily_expense as $key => $value) {
            $profit = 0;
            // dd($value);
            // die;
            foreach ($value as $key2 => $value2) {
                $profit += $value2->total;
            }
            $expense_p[(int) $key] = $profit;


        }
        $purchase_p = [];
        foreach ($purchase as $key => $value) {
            $profit = 0;
            // dd($value);
            // die;
            foreach ($value as $key2 => $value2) {
                $profit += $value2->total;
            }
            $purchase_p[(int) $key] = $profit;


        }
        $sale_p = [];
        foreach ($sale as $key => $value) {
            $profit = 0;
            // dd($value);
            // die;
            foreach ($value as $key2 => $value2) {
                $profit += $value2->total;
            }
            $sale_p[(int) $key] = $profit;


        }
        $profit_arr = [];
        $loss_arr = [];
        for ($i = 0; $i < 12; $i++) {
            if (!empty($purchase_p[$i + 1]) && !empty($sale_p[$i + 1])) {

                $a = $sale_p[$i + 1] - $purchase_p[$i + 1] - $expense_p[$i + 1];
                if ($a < 0) {
                    // $loss_arr[$i] = -1*$a;
                    $loss_arr[$i] = 0;
                    $profit_arr[$i] = 0;
                } else {
                    $loss_arr[$i] = 0;
                    $profit_arr[$i] = $a;

                }

            } elseif (!empty($sale_p[$i + 1])) {
                $loss_arr[$i] = 0;
                $profit_arr[$i] = $sale_p[$i + 1];
            } elseif (!empty($purchase_p[$i + 1])) {
                $loss_arr[$i] = $purchase_p[$i + 1] + $expense_p[$i + 1];
                $profit_arr[$i] = 0;
            } else {
                $loss_arr[$i] = 0;
                $profit_arr[$i] = 0;

            }

        }

        return $this->chart->barChart()
            ->setTitle('Monthly Profit')
            ->setSubtitle('')
            // ->addData('', $loss_arr)
            ->addData('profit', $profit_arr)
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June', 'july', 'August', 'September', 'October', 'November', 'December']);
    }
}