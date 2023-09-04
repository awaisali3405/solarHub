<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Accessories;
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
    public function suggestProduct(Request $request){
        foreach ($request->detail as $key => $value) {
            if($key!='total'){
                $value=json_decode($value);
                
            }
        }
    }
}
