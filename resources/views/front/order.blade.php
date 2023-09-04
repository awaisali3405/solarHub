@extends('front.layouts.app')
@section('content')
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="product-content-right">
                        <div class="woocommerce">

                            <table cellspacing="0" class="shop_table cart">
                                <thead>
                                    <tr>
                                        <th class="product-remove">Order #</th>
                                        <th class="product-thumbnail">&nbsp;</th>
                                        <th class="product-name">Products</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-subtotal">Total</th>
                                        <th class="product-subtotal">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse  ($order as $value)
                                        <tr class="cart_item">
                                            <td class="product-remove">
                                                {{ $value->order_id }}
                                            </td>

                                            <td class="product-thumbnail">
                                                <a href="single-product.html"><img width="145" height="145"
                                                        alt="poster_1_up" class="shop_thumbnail"
                                                        src="{{ asset($value->product->img) }}"></a>
                                            </td>

                                            <td class="product-name">
                                                <a
                                                    href="{{ route('front.product.detail', $value->product_id) }}">{{ $value->product->name }}</a>
                                            </td>

                                            <td class="product-price">
                                                <span class="amount">Rs{{ $value->product->sale_price }}</span>
                                            </td>

                                            <td class="product-quantity">
                                                <div class="quantity buttons_added">
                                                    {{-- <form action="{{ route('front.update.quantity') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="cart_id" value="{{ $value->id }}"> --}}
                                                    {{-- <input type="button" class="minus" value="-"> --}}
                                                    <input type="number" size="4" class="input-text qty text"
                                                        name="quantity" title="Qty" value="{{ $value->quantity }}"
                                                        min="0" step="1" readonly>
                                                    {{-- <input type="button" class="plus" value="+">
                                                        <button type="submit">update</button> --}}

                                                    {{-- </form> --}}
                                                </div>
                                            </td>

                                            <td class="product-subtotal">
                                                <span
                                                    class="amount">Rs{{ $value->product->sale_price * $value->quantity }}</span>
                                            </td>
                                            <td class="product-subtotal">
                                                @if($value->status_id==9)
                                                <span class="amount">Pending</span>
                                                @elseif($value->feedback!=-1)
                                                    @for($i=0;$i<$value->feedback;$i++)
                                                        <i class="fa-solid fas fa-star"> </i>
                                                    @endfor
                                                @elseif($value->status_id==10)
                                                    <span class="amount">Completed</span>
                                                    <a class="btn btn-secondary" href="{{route('front.product.feedback',$value->id)}}" >Feedback</a>
                                                @else

                                                    <span class="amount">In Process</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>No Order </td>
                                        </tr>
                                    @endforelse
                                    {{-- <tr>
                                        <td class="actions" colspan="6">


                                            <a
                                                class="btn btn-primary w-25 checkout-button button alt wc-forward">CheckOut</a>
                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
