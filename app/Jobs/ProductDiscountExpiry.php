<?php

namespace App\Jobs;

use App\Models\AttributeProduct;
use App\Models\Cart;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Controllers\Admin\Auth\CustomAuth\DB;
use App\Http\Controllers\Admin\Auth\CustomAuth\Log;

class ProductDiscountExpiry implements ShouldQueue
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
         $product = Product::find($this->productId);
         if($product->getDiscountIsExpiredAttribute())
         {
             $product->update([
                 'discount'=> 0,
                 'expiry_date'=> ''
             ]);
             UpdateMinMaxPriceOfProduct::dispatch($product->id);
             app('App\Http\Repositories\CartRepository')->delete($this->productId,false,true);
         }
    }
}
