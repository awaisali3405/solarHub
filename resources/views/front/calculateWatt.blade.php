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
                                            <li class="active">Calculate Watt</li>
                                        </ol>
                                    </div>
                                    {{-- asaas {!! __(session()->get('success')) !!} --}}
                                    <div class="table-responsive cart_info " style="width: 50%; margin-left: 20%">
                                        <table class="table table-condensed">
                                            <thead>
                                                <tr class="cart_menu">
                                                    {{-- <th class="price text-center">Accessories</th>
                                                        <th class="price text-center">Quantity</th>
                                                        <th class="price text-center">Action</th> --}}
                                                    <th class="">Sr#</th>
                                                    <th class="price text-center">Accessories</th>
                                                    <th class="price text-center">Quantity</th>
                                                    <th class="price text-center">Watt</th>
                                                </tr>
                                            </thead>
                                            <tbody class=" addRow">


                                                @foreach ($detail as $key => $value)
                                                    <input type="hidden" name="detail[{{ $key }}]"
                                                        value="{{ $value }}">
                                                    @if ($key != 'total')
                                                        {{-- @dd($value['name']) --}}
                                                        <tr class="d-flex justify-content-center">
                                                            <td class="text-center">{{ $key + 1 }}</td>
                                                            <td class="text-center">{{ $value['name'] }}</td>
                                                            <td class="text-center"
                                                                style="display: flex; justify-content: center;">
                                                                {{ $value['quantity'] }}</td>
                                                            <td class="text-center">
                                                                {{ $value['watt'] * $value['quantity'] }}
                                                                watt
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                <tr>

                                                    <th colspan="3" class="text-center">Total</th>
                                                    <th class="text-center">{{ $detail['total'] }} Watt</th>
                                                </tr>




                                            </tbody>
                                            <thead>
                                                <tr>
                                                    <td colspan="4" class="text-center"><span
                                                            class="btn btn-primary suggest">Suggest
                                                        </span>
                                                    </td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </section>

                            <div class="single-product-area packages"
                                style="background-color: #fbfbfb; border-radius: 20px; padding-bottom:5%;">
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


                                                    <a href="{{ route('front.calculate.product', [1, $detail['total']]) }}"
                                                        for="basic" class="btn btn-primary">Select</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="single-shop-product"
                                                style="background-color: rgba(221, 221, 221, 0.644); border-radius: 20px; padding-right: 20px;">
                                                <div class="product-upper text-center" style="padding:1rem 1rem 1rem 1rem;">
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


                                                    <a href="{{ route('front.calculate.product', [2, $detail['total']]) }}"
                                                        for="basic" class="btn btn-primary">Select</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="single-shop-product"
                                                style="background-color: rgba(221, 221, 221, 0.644); border-radius: 20px; padding-right: 20px;">
                                                <div class="product-upper text-center" style="padding:1rem 1rem 1rem 1rem;">
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

                                                    <a href="{{ route('front.calculate.product', [3, $detail['total']]) }}"
                                                        for="basic" class="btn btn-primary">Select</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


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
