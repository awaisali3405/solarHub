<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Controllers\Admin\Auth\CustomAuth\Log;

class UpdateMinMaxPriceOfProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $productId;
    public function __construct($productId)
    {
        $this->productId = $productId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $product = Product::with(['allAttributesProduct'=>function($query){

            $query->where('parent_attribute_id','>',0);
            $query->where('price','>',0);

        }])->findOrFail($this->productId);
        if ($product)
            $minPrice = $product->allAttributesProduct->min('price');
        $maxPrice = $product->allAttributesProduct->max('price');
        $minMaxPriceArray = [
            'min_price' => '',
            'max_price' => ''
        ];
        //with attributes
        if (count($product->allAttributesProduct)>0)
        {
            $minMaxPriceArray['min_price'] = $minPrice;
            $minMaxPriceArray['max_price'] = $maxPrice;
        }

        if (count($product->allAttributesProduct)>0 && $product->discount>0)
        {
            $minMaxPriceArray['min_price'] =  $minPrice - $minPrice * ($product->discount / 100);
            $minMaxPriceArray['max_price'] =  $maxPrice - $maxPrice * ($product->discount / 100);
        }

        //with discount and no attributes
        if (count($product->allAttributesProduct) == 0 &&$product->discount>0)
        {
            $minMaxPriceArray['min_price'] = $product->price - $product->price * ($product->discount / 100);
            $minMaxPriceArray['max_price'] = $product->price -$product->price * ($product->discount / 100);
        }

        if (count($product->allAttributesProduct) == 0 &&$product->discount == 0)
        {
            $minMaxPriceArray['min_price'] = $product->price  ;
            $minMaxPriceArray['max_price'] = $product->price  ;
        }

        $product->update([
            'min_price' => $minMaxPriceArray['min_price'],
            'max_price' =>$minMaxPriceArray['max_price']
        ]);


    }
}
