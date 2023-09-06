<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\front\Controller;
use App\Models\Cart;
use App\Models\Feedback;
use App\Models\OOrder;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct() {
        parent::__construct();
    }
    public function index()
    {
        $product = Product::where('status', 1)->get();

        return view('home', ['product' => $product]);
    }

    public function testPage()
    {
        return "Paypal";
    }
    public function showProduct()
    {
        $product = Product::where('status', 1)->paginate(12);
        // dd($products->lastPage());
        return view('front.shop', ['product' => $product]);
    }
    public function addCart($id)
    {

        $quantity = Cart::where('product_id', $id)->where('customer_id', auth()->user()->id)->where('order_id', null)->limit(1)->get('quantity');
        // dd($quantity);
        if (count($quantity) > 0) {
            $quantity = $quantity[0]->quantity;
            $quantity++;
            Cart::where('product_id', $id)->where('customer_id', auth()->user()->id)->update(['quantity' => $quantity]);

        } else {

            Cart::create([
                'product_id' => $id,
                'customer_id' => auth()->user()->id,
                'quantity' => 1,

            ]);
        }
        return redirect()->back()->with('success', 'Add to Cart Successfully');
    }
    public function removeCart($id)
    {

        Cart::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Remove Product Successfully');
    }
    public function addToCartQuantity(Request $request){
        $data = $request->except('_token');
        if($data['quantity']>0){

            Cart::create([
                'product_id' => $data['product_id'],
                'customer_id' => auth()->user()->id,
                'quantity' => $data['quantity'],

            ]);
            return redirect()->back()->with('success', 'Add to Cart Successfully');
        }else{
            return redirect()->back()->with('error',"Enter some quantity before adding");
        }

    }
    public function addToCart(Request $request)
    {
        $data = $request->except('_token');
        // $quantity = Cart::find($data['card_id'])->quantity;
        // // dd($quantity);
        // if ($quantity > 0) {
        //     // $quantity = $quantity[0]->quantity;
        //     $quantity = $quantity + $data['quantity'];
            Cart::find($data['card_id'])->update(['quantity' => $data['quantity']]);
        // } else {
        //     // dd('as');
        //     Cart::create([
        //         'product_id' => $data['product_id'],
        //         'customer_id' => auth()->user()->id,
        //         'quantity' => 1,

        //     ]);
        // }
        return redirect()->back()->with('success', 'Cart Update Successfully');
    }
    public function showCart()
    {
        $cart = Cart::where('customer_id', auth()->user()->id)->where('order_id', null)->get();
        // dd($cart);
        $order_total = 0;
        foreach ($cart as $key => $value) {
            $order_total += $value->product->sale_price * $value->quantity;
        }
        return view('front.cart', ['cart' => $cart, 'total' => $order_total]);
    }
    public function productDetail($id)
    {
        $product = Product::findOrFail($id);
        $detail=Product::where('category_id',$product->category_id)->where('id','!=',$id)->get();
        return view('front.productDetail', ['product' => $product,'detail'=>$detail]);
    }
    public function updateQuantity(Request $request)
    {
        Cart::where('id', $request->cart_id)->update(['quantity' => $request->quantity]);
        return redirect()->back()->with('success', 'Quantity Updated Successfully');
    }
    public function order()
    {
        $order_id = rand(2, 50000);

        $cart = Cart::where('customer_id', auth()->user()->id)->where("order_id", null)->get();
        foreach ($cart as $key => $value) {

            $product = Product::findOrFail($value->product_id);
            // dd($product);
            if ($product->stock >= $value->quantity) {
                $quantity = $product->stock - $value->quantity;
                $product = Product::where('id', $value->product_id)->update(['stock' => $quantity]);
            } else {
                $quantity = $value->quantity - $product->stock;
                Cart::where('id', $value->id)->update(['need_stock' => $quantity]);

            }
        }
        Cart::where('customer_id', auth()->user()->id)->where("order_id", null)->update(['order_id' => $order_id]);
        OOrder::create(['order_id' => $order_id, 'customer_id' => auth()->user()->id]);
        $order = Cart::where('customer_id', auth()->user()->id)->where("order_id", '!=', null)->get();
        return redirect()->route('front.order.show')->with('success', 'Order Placed Successfully');
    }
    public function showOrder()
    {
        $order = Cart::where('customer_id', auth()->user()->id)->where("order_id", '!=', null)->get();
        // dd($order_id);
        // $order_product = collect();
        // foreach ($order as $key => $value) {
        //     dd($value->cart);
        // }
        // $order = Cart::where("order", $order)->get();
        return view('front.order', ['order' => $order]);

    }
    public function searchProduct(Request $request){
        $search=$request->get('value');
        $product = Product::where('name', 'LIKE', '%' . $search . '%')->where('category_id',1)->orWhere('sale_price','LIKE','%'.$search.'%')->get();
       $string="";
        foreach ($product as $value) {


            $string .= ' <div class="col-md-3 col-sm-6">
                        <div class="single-shop-product">
                            <div class="product-upper">
                                <img src=" '.asset($value->img).' " alt="" style="width: 195px; height: 245px;">
                            </div>
                            <h2><a href="{{ route("front.product.detail", '.$value->id.') }}">'. $value->name .'</a></h2>
                            <div class="product-carousel-price">
                                Rs<ins> '. $value->sale_price .'</ins>
                            </div>

                            <div class="product-option-shop">
                                <a class="add_to_cart_button" rel="nofollow"
                                    href="{{ route("front.product.cart.add", '.$value->id.') }}">Add to cart</a>
                            </div>
                        </div>
                    </div>';
        }
        echo $string;
    }
    public function productFeedback($id){
        $cart=Cart::findOrFail($id);

         return view('front.feedback',['id'=>$id,'cart'=>$cart]);
    }
    public function sendFeedback(Request $request, $id){
//        dd($request);

        Feedback::create([
            'rating'=>$request->rating,
            'feedback'=>$request->feedback,
            'order_id'=>$id,
            'product_id'=>$request->product_id,
            'user_id'=>auth()->user()->id
        ]);
        Cart::where('id',$id)->update(['feedback'=>$request->rating]);
        return redirect(route('front.order.show'))->with('success',"Feedback submitted Successfully");
    }

}
