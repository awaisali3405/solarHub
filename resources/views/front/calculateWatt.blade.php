@extends('front.layouts.app')
@section('content')
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="product-content-right">
                        <div class="woocommerce  " style="display: flex; justify-content: center;">
                            <form method="POST" enctype="multipart/form-data">
                                @csrf
                                <table cellspacing="0" class="shop_table cart ">
                                    <thead>
                                        <tr>

                                            <th class="">sr#</th>
                                            <th class="product-name">Accessories</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Watt</th>
                                        </tr>
                                    </thead>
                                    <tbody class="addRow">
                                        {{-- {{ dd($cart) }} --}}
                                        @foreach ($detail as $key => $value)
                                            <input type="hidden" name="detail[{{ $key }}]"
                                                value="{{ $value }}">
                                            @if ($key != 'total')
                                                {{-- @dd($value['name']) --}}
                                                <tr class="d-flex justify-content-center">
                                                    <td class="">{{ $key + 1 }}</td>
                                                    <td class="">{{ $value['name'] }}</td>
                                                    <td class="" style="display: flex; justify-content: center;">
                                                        {{ $value['quantity'] }}</td>
                                                    <td class="">{{ $value['watt'] * $value['quantity'] }} watt
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        <tr>

                                            <th colspan="3">Total</th>
                                            <th>{{ $detail['total'] }} Watt</th>
                                        </tr>
                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th colspan="4"> <span class="btn btn-primary suggest">Suggest
                                                </span>
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                                <div class="single-product-area packages"
                                    style="background-color: #fbfbfb; border-radius: 20px">
                                    <div class="text-center">
                                        <h2 style="">Packages</h2>
                                        <p style="margin-bottom: 5%">
                                            Select quality you want to choose</p>
                                    </div>
                                    <div class="container">
                                        <div class="row " style="display: flex; justify-content: center;">
                                            <div class="col-md-3 col-sm-6 ">
                                                <div class="single-shop-product"
                                                    style="background-color: rgba(221, 221, 221, 0.644); border-radius: 20px; padding-right: 20px;">
                                                    <div class="product-upper text-center "
                                                        style="padding:1rem 1rem 1rem 1rem;">
                                                        <h2>Basic</h2>
                                                    </div>
                                                    <h4>
                                                        <ul>
                                                            <li> B Grade Panel</li>
                                                            <li> Convert with low quality</li>
                                                        </ul>
                                                    </h4>

                                                    <div class="product-option-shop "
                                                        style="display: flex; justify-content: center;  padding:1rem 1rem 1rem 1rem;">

                                                        <button formaction="{{ route('front.calculate.product', 0) }}"
                                                            for="basic" class="btn btn-primary">Select</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <div class="single-shop-product"
                                                    style="background-color: rgba(221, 221, 221, 0.644); border-radius: 20px; padding-right: 20px;">
                                                    <div class="product-upper text-center"
                                                        style="padding:1rem 1rem 1rem 1rem;">
                                                        <h2>Standard</h2>
                                                    </div>
                                                    <h4>
                                                        <ul>
                                                            <li> A Grade Panel</li>
                                                            <li> Convert with Medium quality</li>
                                                        </ul>
                                                    </h4>

                                                    <div class="product-option-shop"
                                                        style="display: flex; justify-content: center;  padding:1rem 1rem 1rem 1rem;">

                                                        <button for="basic"
                                                            formaction="{{ route('front.calculate.product', 1) }}"
                                                            class="btn btn-primary">Select</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <div class="single-shop-product"
                                                    style="background-color: rgba(221, 221, 221, 0.644); border-radius: 20px; padding-right: 20px;">
                                                    <div class="product-upper text-center"
                                                        style="padding:1rem 1rem 1rem 1rem;">
                                                        <h2>Premium</h2>
                                                    </div>
                                                    <h4>
                                                        <ul>
                                                            <li> A+ Grade Panel</li>
                                                            <li> Convert with High quality</li>
                                                            <li> Battery</li>
                                                        </ul>
                                                    </h4>

                                                    <div class="product-option-shop"
                                                        style="display: flex; justify-content: center;  padding:1rem 1rem 1rem 1rem;">

                                                        <button for="basic" class="btn btn-primary">Select</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>


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
            $('.cart').hide();
        })
    </script>
@endsection
