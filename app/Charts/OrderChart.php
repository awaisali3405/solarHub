<?php

namespace App\Charts;

use App\Models\Order;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class OrderChart
{
    protected $chart2;

    public function __construct(LarapexChart $chart2)
    {
        $this->chart2 = $chart2;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {

        $order = Order::all();
        $orderArr = [];
        $meltingArr = [];
        $furnaceArr = [];
        $castingArr = [];
        $overflowArr = [];
        $addChipArr = [];
        $freshIgniteArr = [];
        $PaintArr = [];
        $inProcessArr = [];
        $pendingArr = [];
        foreach ($order as $key => $value) {
            $orderArr[$key] = $value->id;
            if ($value->status_id == 1) {
                $furnaceArr[$key] = $value->status_id;
                $meltingArr[$key] = 0;
                $castingArr[$key] = 0;
                $overflowArr[$key] = 0;
                $addChipArr[$key] = 0;
                $freshIgniteArr[$key] = 0;
                $PaintArr[$key] = 0;
                $inProcessArr[$key] = 0;
                $pendingArr[$key] = 0;
            } else if ($value->status_id == 2) {
                $furnaceArr[$key] = 0;
                $meltingArr[$key] = $value->status_id;
                $castingArr[$key] = 0;
                $overflowArr[$key] = 0;
                $addChipArr[$key] = 0;
                $freshIgniteArr[$key] = 0;
                $PaintArr[$key] = 0;
                $inProcessArr[$key] = 0;
                $pendingArr[$key] = 0;

            } else if ($value->status_id == 3) {
                $furnaceArr[$key] = 0;
                $meltingArr[$key] = 0;
                $castingArr[$key] = $value->status_id;
                $overflowArr[$key] = 0;
                $addChipArr[$key] = 0;
                $freshIgniteArr[$key] = 0;
                $PaintArr[$key] = 0;
                $inProcessArr[$key] = 0;
                $pendingArr[$key] = 0;


            } else if ($value->status_id == 4) {
                $furnaceArr[$key] = 0;
                $meltingArr[$key] = 0;
                $castingArr[$key] = 0;
                $overflowArr[$key] = $value->status_id;
                $addChipArr[$key] = 0;
                $freshIgniteArr[$key] = 0;
                $PaintArr[$key] = 0;
                $inProcessArr[$key] = 0;
                $pendingArr[$key] = 0;


            } else if ($value->status_id == 5) {
                $furnaceArr[$key] = 0;
                $meltingArr[$key] = 0;
                $castingArr[$key] = 0;
                $overflowArr[$key] = 0;
                $addChipArr[$key] = $value->status_id;
                $freshIgniteArr[$key] = 0;
                $PaintArr[$key] = 0;
                $inProcessArr[$key] = 0;
                $pendingArr[$key] = 0;

            } else if ($value->status_id == 6) {
                $furnaceArr[$key] = 0;
                $meltingArr[$key] = 0;
                $castingArr[$key] = 0;
                $overflowArr[$key] = 0;
                $addChipArr[$key] = 0;
                $freshIgniteArr[$key] = $value->status_id;
                $PaintArr[$key] = 0;
                $inProcessArr[$key] = 0;
                $pendingArr[$key] = 0;

            } else if ($value->status_id == 7) {
                $furnaceArr[$key] = 0;
                $meltingArr[$key] = 0;
                $castingArr[$key] = 0;
                $overflowArr[$key] = 0;
                $addChipArr[$key] = 0;
                $freshIgniteArr[$key] = 0;
                $PaintArr[$key] = $value->status_id;
                $inProcessArr[$key] = 0;
                $pendingArr[$key] = 0;

            } else if ($value->status_id == 8) {
                $furnaceArr[$key] = 0;
                $meltingArr[$key] = 0;
                $castingArr[$key] = 0;
                $overflowArr[$key] = 0;
                $addChipArr[$key] = 0;
                $freshIgniteArr[$key] = 0;
                $PaintArr[$key] = 0;
                $inProcessArr[$key] = $value->status_id;
                $pendingArr[$key] = 0;

            } else {
                $furnaceArr[$key] = 0;
                $meltingArr[$key] = 0;
                $castingArr[$key] = 0;
                $overflowArr[$key] = 0;
                $addChipArr[$key] = 0;
                $freshIgniteArr[$key] = 0;
                $PaintArr[$key] = 0;
                $inProcessArr[$key] = 0;
                $pendingArr[$key] = $value->status_id;

            }
        }
        // dd($orderArr);
        return $this->chart2->barChart()
            ->setTitle('Order Tracking')
            ->setSubtitle('Order Status')
            ->addData('Furnace', $furnaceArr)
            ->addData('Melting', $meltingArr)
            ->addData('Casting', $castingArr)
            ->addData('Overflow', $overflowArr)
            ->addData('Add Chips', $addChipArr)
            ->addData('Fresh Ignite', $freshIgniteArr)
            ->addData('Paint', $PaintArr)
            ->addData('InProcess', $inProcessArr)
            ->addData('Pending', $pendingArr)
            ->setXAxis($orderArr);
    }
}