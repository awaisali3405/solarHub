<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Accessories;
use App\Models\Product;
use Illuminate\Http\Request;

class CalculateController extends Controller
{
    public function index(){
        $accessories=Accessories::where('status',1)->get();
        return view('front.calculate', compact('accessories'));
    }
    public function getAccessories(){
        return Accessories::where('status',1)->get();
        }
        public function calculateIndustrialWatt(Request $request){
            $daily=($request->monthly_unit/30)/$request->monthly_hour;

            dd($daily);

        }
        public function calculateWatt(Request $request){
        // dd($request);
        $detail=array();
        $totalWatt=0;
        foreach($request->accessories as $key=> $value){
            $accessories= Accessories::find($value);
            $accessories->quantity=$request->quantity[$key];
            $totalWatt+=$accessories->watt*$request->quantity[$key];
            array_push($detail,$accessories);

        }
        $detail['total']=$totalWatt;
        // dd($detail);
        return view('front.calculateWatt',['detail'=>$detail]);
    }
    public function suggestProduct($type,$watt){
        $temp=$watt;
        $totalSolar=0;
        $len=mb_strlen($temp);
        for ($i=0; $i < $len-1; $i++) {
            $temp=$temp/10;
        }
        $temp=ceil($temp);
        for ($i=0; $i < $len-1; $i++) {
            $temp=$temp*10;
        }
        $product=collect();
        // $watt=ceil();
        $solar=Product::where('sub_category_id',$type)->where('category_id',1)->where('stock','>',0);
        $closetValue= $solar->pluck('watt')->pipe(function($data)use($watt){
            $closest = null;

    foreach ($data as $item) {
        if ($closest === null || abs($watt - $closest) > abs($item - $watt)) {
            $closest = $item;
        }
    }

    return $closest;
        });
        if($closetValue>=$watt){
            $product->add($solar->where('watt',$closetValue)->first());
        }else{
            $closet=0;
            $check=true;
            $count=0;
            while($check){
                $count++;
                $closet+=$closetValue;
                if($closet>=$watt){
                    $check=false;
                }
            }

                $lower=$solar->where('watt',$closetValue)->first();
                $lower->quantity=$count;
                $product->add($lower);

        }


     $inverter=Product::where('sub_category_id',$type)->where('category_id',2)->where('stock','>',0);
     $closetValue= $inverter->pluck('watt')->pipe(function($data)use($watt){
        $closest = null;

foreach ($data as $item) {
    if ($closest === null || abs($watt - $closest) > abs($item - $watt)) {
        $closest = $item;
    }
}

return $closest;
    });
    if($closetValue>=$watt){
        $greater=$inverter->where('watt',$closetValue)->first();
        $greater->quantity=1;
        $product->add($greater);
    }else{
        $closet=0;
        $check=true;
        $count=0;
        while($check){
            $count++;
            $closet+=$closetValue;
            if($closet>=$watt){
                $check=false;
            }
        }

            $lower=$inverter->where('watt',$closetValue)->first();
            $lower->quantity=$count;
            $product->add($lower);

    }
    $battery=Product::where('sub_category_id',$type)->where('category_id',3)->where('stock','>',0);
    $closetValue= $battery->pluck('watt')->pipe(function($data)use($watt){
       $closest = null;

foreach ($data as $item) {
   if ($closest === null || abs($watt - $closest) > abs($item - $watt)) {
       $closest = $item;
   }
}

return $closest;
   });
   if($closetValue>=$watt){
       $greater=$battery->where('watt',$closetValue)->first();
       $greater->quantity=1;
       $product->add($greater);
   }else{
       $closet=0;
       $check=true;
       $count=0;
       while($check){
           $count++;
           $closet+=$closetValue;
           if($closet>=$watt){
               $check=false;
           }
       }

           $lower=$battery->where('watt',$closetValue)->first();
           $lower->quantity=$count;
           $product->add($lower);

   }
    // dd($product);
        return view('front.suggestProduct',['product'=>$product]);

    }
}
