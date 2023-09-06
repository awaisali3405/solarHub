@extends('front.layouts.app')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Item</td>
                            <td class="description"></td>
                            <td class="price">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Total</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (auth()->user()->cart as $value)
                            <tr>
                                <td class="cart_product">
                                    <a href=""><img src="{{ $value->product->img }}" alt="" width="110"
                                            height="110"></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a
                                            href="{{ route('front.product.detail', $value->id) }}">{{ $value->product->name }}</a>
                                    </h4>
                                    <p> </p>
                                </td>
                                <td class="cart_price">
                                    <p>Rs.{{ $value->product->sale_price }}</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        {{-- <a class="cart_quantity_up" href=""> + </a> --}}
                                        <form action="{{ route('front.product.cart.addTo') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="card_id" value="{{ $value->id }}">
                                            <input class="cart_quantity_input" type="text" name="quantity"
                                                value="{{ $value->quantity }}" autocomplete="off" size="2">
                                            <button><i class="fa fa-pencil"></i></button>
                                        </form>
                                        {{-- <a class="cart_quantity_down" href=""> - </a> --}}
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">Rs.{{ $value->quantity * $value->product->sale_price }}</p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete"
                                        href="{{ route('front.product.cart.remove', $value->id) }}"><i
                                            class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!--/#cart_items-->

    <section id="do_action">
        <div class="container">
            <div class="heading">
                <h3>What would you like to do next?</h3>
                <p>Choose if you have a discount code or reward points you want to use or would like to estimate your
                    delivery cost.</p>
            </div>
            <div class="row">
                <div class="col-sm-6 align-content-center">
                    <div class="total_area">
                        <ul>
                            <li>Cart Sub Total <span>Rs.{{ auth()->user()->cartTotal() }}</span></li>
                            <li>Shipping Cost <span>Free</span></li>
                            <li>Total <span>Rs.{{ auth()->user()->cartTotal() }}</span></li>
                        </ul>
                        <a class="btn btn-default check_out" href="{{ route('front.product.order') }}">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#do_action-->
    {{-- <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="product-content-right">
                        <div class="woocommerce">
                            {{-- asaas {!! __(session()->get('success')) !!} --}}
    {{-- <table cellspacing="0" class="shop_table cart">
                                <thead>
                                    <tr>
                                        <th class="product-remove">&nbsp;</th>
                                        <th class="product-thumbnail">&nbsp;</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-subtotal">Total</th>
                                    </tr>
                                </thead>
                                <tbody> --}}
    {{-- {{ dd($cart) }} --}}
    {{-- @forelse ($cart as $value)
                                        <tr class="cart_item">
                                            <td class="product-remove">
                                                <a title="Remove this item" class="remove"
                                                    href="{{ route('front.product.cart.remove', $value->id) }}">×</a>
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
                                                    <form action="{{ route('front.update.quantity') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="cart_id" value="{{ $value->id }}">
                                                        <input type="button" class="minus" value="-">
                                                        <input type="number" size="4" class="input-text qty text"
                                                            name="quantity" title="Qty" value="{{ $value->quantity }}"
                                                            min="1" step="1">
                                                        <input type="button" class="plus" value="+">
                                                        <button type="submit">update</button>

                                                    </form>
                                                </div>
                                            </td>

                                            <td class="product-subtotal">
                                                <span class="amount">Rs
                                                    {{ $value->product->sale_price * $value->quantity }}</span>
                                            </td>
                                        </tr>

                                    @empty
                                        <tr class="">
                                            <td>
                                                No Product in the cart
                                            </td>
                                        </tr>
                                    @endforelse
                                    <tr>
                                        <td class="actions" colspan="6">
                                            <div wire:ignore>
                                                <div id="paypal-button-container"></div>


                                            </div>

                                            <a href="{{ route('front.product.order') }}"
                                                class="btn btn-primary w-25 checkout-button button alt wc-forward">CheckOut</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                            <div class="cart-collaterals">


                                <div class="cart_totals ">
                                    <h2>Cart Totals</h2>

                                    <table cellspacing="0">
                                        <tbody>
                                            <tr class="cart-subtotal">
                                                <th>Cart Subtotal</th>
                                                <td><span class="amount">{{ $total }}</span></td>
                                            </tr>

                                            <tr class="shipping">
                                                <th>Shipping and Handling</th>
                                                <td>Free Shipping</td>
                                            </tr>

                                            <tr class="order-total">
                                                <th>Order Total</th>
                                                <td><strong><span class="amount">{{ $total }}</span></strong> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>





                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    {{-- </div>
    <script
        src="https://www.paypal.com/sdk/js?client-id=AYBpDpRJqtN3ZOqZVs9ZF-aS4bD8EO8LvcN7A-_X1HkNIPXM6ADA7W_a9CfRx5jUOEuiwkkQhMSwKe7_&currency=USD">
    </script>
    <script>
        // $(function() {
        //     $('#img').on('change', function(event) {
        //         var tmppath = URL.createObjectURL(event.target.files[0]);
        //         console.log(tmppath)
        //         $('#blah').attr("src", tmppath);
        //     })
        // })
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: {{ $total }}
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {
                    // console.log(orderData);
                    // alert('Thanks for shopping')
                    //console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var img = $('#img').val()

                    $.ajax({
                        url: "product/order",
                        method: 'POST',
                        data: {
                            {{-- order: {{ $order->id }} --}}
    {{-- },
                        success: function(result) {
                            console.log(result);
                            window.location = result
                            toastr.success(" Payment recieved Successfully", 'Success');
                            // $('#subCategory').html(result);
                        },
                        error: (error) => {
                            alert("Error")
                        }
                    })

                });
            }
        }).render('#paypal-button-container'); --}}
    {{-- </script> --}}
@endsection
