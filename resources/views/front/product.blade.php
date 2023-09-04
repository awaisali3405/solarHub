@extends('front.layouts.app')

@section('content')
    <style>
        #search {


            margin-left: 40%;
            width: 300px;
            height: 40px;
            margin-bottom: 1%;
            border-radius: 11px;
            margin-top: 0.1%;
        }
    </style>
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Product</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="single-product-area">

        <div class="zigzag-bottom"><h2 style="margin-left: 43%;">Search Product</h2>
            <input class="" type="search" name="search" id="search" style=""></div>
        <div class="container" >
            <div class="row" id="product">
                @foreach ($product as $value)
                    <div class="col-md-3 col-sm-6">
                        <div class="single-shop-product">
                            <div class="product-upper">
                                <img src="{{ asset($value->img) }}" alt="" style="width: 195px; height: 245px;">
                            </div>
                            <h2><a href="{{ route('front.product.detail', $value->id) }}">{{ $value->name }}</a></h2>
                            <div class="product-carousel-price">
                                Rs<ins> {{ $value->sale_price }}</ins>
                            </div>

                            <div class="product-option-shop">
                                <a class="add_to_cart_button" rel="nofollow"
                                    href="{{ route('front.product.cart.add', $value->id) }}">Add to cart</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>


        </div>
    </div>
    <script>
        $(function (){

            $('#search').on('change',function (){

                var search=$("#search").val();
                $.ajax({
                    method: "POST",
                    url: "api/search/product",
                    data: {
                        value: search
                    },
                    success: function(response) {
                        console.log(response);
                        $('#product').html(response);
                        //   startAutoComplete(response);
                    }

                });
            })

        })

    </script>
@endsection
