@extends('front.layouts.app')
@section('content')
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="product-content-right">
                        <div class="woocommerce  " style=" padding-bottom:20%;">

                            <section id="cart_items">
                                <div class="container">
                                    <div class="breadcrumbs">
                                        <ol class="breadcrumb">
                                            <li><a href="/">Home</a></li>
                                            <li class="active">Suggest</li>
                                        </ol>
                                    </div>
                                    <form action="{{ route('front.suggest.add.to.cart') }}" method="POST">
                                        @csrf
                                        <div class="table-responsive cart_info " style="width: 50%; margin-left: 20%">
                                            <table class="table table-condensed">
                                                <thead>
                                                    <tr class="cart_menu">
                                                        {{-- <th class="price text-center">Accessories</th>
                                                            <th class="price text-center">Quantity</th>
                                                            <th class="price text-center">Action</th> --}}
                                                        <th class="">Sr#</th>
                                                        <th class="price text-center">Product</th>
                                                        <th class="price text-center">Quantity</th>
                                                        <th class="price text-center">Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody class=" addRow">

                                                    @php
                                                        $total = 0;
                                                    @endphp
                                                    @foreach ($product as $key => $value)
                                                        {{-- @dd($value['name']) --}}
                                                        <tr class="d-flex justify-content-center">
                                                            <td class="text-center">{{ $key + 1 }}</td>
                                                            <td class="text-center">{{ $value['name'] }}
                                                                <input type="hidden" name="product[]"
                                                                    value="{{ $value->id }}">
                                                                <input type="hidden" name="quantity[]"
                                                                    value="{{ $value->quantity }}">
                                                            </td>
                                                            <td class="text-center"
                                                                style="display: flex; justify-content: center;">
                                                                {{ $value['quantity'] }}</td>
                                                            <td class="text-center">
                                                                Rs.{{ $value['sale_price'] * $value['quantity'] }}
                                                                @php
                                                                    $total += $value['sale_price'] * $value['quantity'];
                                                                @endphp
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>

                                                        <th colspan="3" class="text-center">Total</th>
                                                        <th class="text-center">Rs.{{ $total }} </th>
                                                    </tr>




                                                </tbody>
                                                <thead>
                                                    <tr>
                                                        <td colspan="4" class="text-center"><button type="submit"
                                                                class="btn btn-primary ">Add To Cart
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </form>
                                    {{-- asaas {!! __(session()->get('success')) !!} --}}
                                </div>
                            </section>




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.packages').hide();
        })
        $('.suggest').on('click', function() {

            $('.packages').show();
            $('.cart_info').hide();
        })
    </script>
@endsection
