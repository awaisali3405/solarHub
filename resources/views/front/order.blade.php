@extends('front.layouts.app')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li class="active">Order</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Order #</td>
                            <td class="image">Item</td>
                            <td class="description">Product Name</td>
                            <td class="price">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Total</td>
                            <td class="total">Status</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (auth()->user()->order as $value)
                            {{-- @dd($value->cart) --}}
                            @foreach ($value->cart as $key => $value2)
                                <tr>
                                    @if ($key == 0)
                                        <td class="cart_price text-center" rowspan="{{ $value->cart->count() }}">
                                            <p class="cart_total_price">
                                                {{ $value->order_id }}
                                            </p>
                                        </td>
                                    @endif
                                    <td class="cart_product">
                                        <a href="{{ route('front.product.detail', $value2->product_id) }}"><img
                                                src="{{ $value2->product->img }}" alt="" width="50"
                                                height="50"></a>
                                    </td>
                                    <td class="cart_price">
                                        <p>
                                        <h4><a
                                                href="{{ route('front.product.detail', $value2->product_id) }}">{{ $value2->product->name }}</a>
                                        </h4>
                                        </p>
                                    </td>
                                    <td class="cart_price">
                                        <p class="cart_total_price">Rs.{{ $value2->product->sale_price }}</p>
                                    </td>
                                    <td class="cart_quantity">
                                        <p>{{ $value2->quantity }}</p>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">
                                            Rs.{{ $value2->quantity * $value2->product->sale_price }}
                                        </p>
                                    </td>
                                    <td class="cart_delete">
                                        <p class="cart_total_price">
                                            @if ($value2->status_id == 5)
                                                <a href="{{ route('front.product.feedback', $value2->id) }}">
                                                    Give Feedback</a>
                                            @elseif($value2->status_id == 6)
                                                @for ($i = 0; $i < $value2->feedback->rating; $i++)
                                                    ⭐
                                                @endfor
                                            @else
                                                {{ $value2->status->name }}
                                            @endif
                                        </p>
                                    </td>
                                    <td>
                                        {{-- {{ $ }} --}}
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!--/#cart_items-->
@endsection
