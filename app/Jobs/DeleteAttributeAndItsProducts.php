<?php

namespace App\Jobs;

use App\Http\Repositories\AttributeRepository;
use App\Http\Repositories\ProductRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DeleteAttributeAndItsProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $id, $attributeRepository, $productRepository, $adminId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $adminId)
    {
        $this->id = $id;
        $this->adminId = $adminId;
        $this->attributeRepository = new AttributeRepository();
        $this->productRepository = new ProductRepository();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       $attribute = $this->attributeRepository->getModel()->withTrashed()->with(['products', 'subAttributes'=>function($q){$q->withTrashed();}])->find($this->id);
       foreach ($attribute->products as $product){
           $this->productRepository->delete($product->id, null,true,$this->adminId);
       }
       foreach ($attribute->subAttributes as $subAttribute){
           $subAttribute->forceDelete();
       }
       $attribute->forceDelete();
    }
}
