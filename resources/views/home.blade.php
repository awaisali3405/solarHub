@extends('front.layouts.app')

@section('content')
    <style>
        @import url(https://fonts.googleapis.com/css?family=Oswald:400,300);
        @import url(https://fonts.googleapis.com/css?family=Open+Sans);

        body {
            font-family: 'Open Sans', sans-serif;
        }

        .popup-box {
            background-color: #ffffff;
            border: 1px solid #b0b0b0;
            bottom: 0;
            display: none;
            height: 415px;
            position: fixed;
            right: 70px;
            width: 300px;
            font-family: 'Open Sans', sans-serif;
        }

        .round.hollow {
            margin: 40px 0 0;
        }

        .round.hollow a {
            border: 2px solid #ff6701;
            border-radius: 35px;
            color: red;
            color: #ff6701;
            font-size: 23px;
            padding: 10px 21px;
            text-decoration: none;
            font-family: 'Open Sans', sans-serif;
        }

        .round.hollow a:hover {
            border: 2px solid #000;
            border-radius: 35px;
            color: red;
            color: #000;
            font-size: 23px;
            padding: 10px 21px;
            text-decoration: none;
        }

        .popup-box-on {
            display: block !important;
        }

        .popup-box .popup-head {
            background-color: #fff;
            clear: both;
            color: #7b7b7b;
            display: inline-table;
            font-size: 21px;
            padding: 7px 10px;
            width: 100%;
            font-family: Oswald;
        }

        .bg_none i {
            border: 1px solid #ff6701;
            border-radius: 25px;
            color: #ff6701;
            font-size: 17px;
            height: 33px;
            line-height: 30px;
            width: 33px;
        }

        .bg_none:hover i {
            border: 1px solid #000;
            border-radius: 25px;
            color: #000;
            font-size: 17px;
            height: 33px;
            line-height: 30px;
            width: 33px;
        }

        .bg_none {
            background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
            border: medium none;
        }

        .popup-box .popup-head .popup-head-right {
            margin: 11px 7px 0;
        }

        .popup-box .popup-messages {}

        .popup-head-left img {
            border: 1px solid #7b7b7b;
            border-radius: 50%;
            width: 44px;
        }

        .popup-messages-footer>textarea {
            border-bottom: 1px solid #b2b2b2 !important;
            height: 34px !important;
            margin: 7px;
            padding: 5px !important;
            border: medium none;
            width: 95% !important;
        }

        .popup-messages-footer {
            background: #fff none repeat scroll 0 0;
            bottom: 0;
            position: absolute;
            width: 100%;
        }

        .popup-messages-footer .btn-footer {
            overflow: hidden;
            padding: 2px 5px 10px 6px;
            width: 100%;
        }

        .simple_round {
            background: #d1d1d1 none repeat scroll 0 0;
            border-radius: 50%;
            color: #4b4b4b !important;
            height: 21px;
            padding: 0 0 0 1px;
            width: 21px;
        }





        .popup-box .popup-messages {
            background: #3f9684 none repeat scroll 0 0;
            height: 275px;
            overflow: auto;
        }

        .direct-chat-messages {
            overflow: auto;
            padding: 10px;
            transform: translate(0px, 0px);

        }

        .popup-messages .chat-box-single-line {
            border-bottom: 1px solid #a4c6b5;
            height: 12px;
            margin: 7px 0 20px;
            position: relative;
            text-align: center;
        }

        .popup-messages abbr.timestamp {
            background: #3f9684 none repeat scroll 0 0;
            color: #fff;
            padding: 0 11px;
        }

        .popup-head-right .btn-group {
            display: inline-flex;
            margin: 0 8px 0 0;
            vertical-align: top !important;
        }

        .chat-header-button {
            background: transparent none repeat scroll 0 0;
            border: 1px solid #636364;
            border-radius: 50%;
            font-size: 14px;
            height: 30px;
            width: 30px;
        }

        .popup-head-right .btn-group .dropdown-menu {
            border: medium none;
            min-width: 122px;
            padding: 0;
        }

        .popup-head-right .btn-group .dropdown-menu li a {
            font-size: 12px;
            padding: 3px 10px;
            color: #303030;
        }

        .popup-messages abbr.timestamp {
            background: #3f9684 none repeat scroll 0 0;
            color: #fff;
            padding: 0 11px;
        }

        .popup-messages .chat-box-single-line {
            border-bottom: 1px solid #a4c6b5;
            height: 12px;
            margin: 7px 0 20px;
            position: relative;
            text-align: center;
        }

        .popup-messages .direct-chat-messages {
            height: auto;
        }

        .popup-messages .direct-chat-text {
            background: #dfece7 none repeat scroll 0 0;
            border: 1px solid #dfece7;
            border-radius: 2px;
            color: #1f2121;
        }

        .popup-messages .direct-chat-timestamp {
            color: #fff;
            opacity: 0.6;
        }

        .popup-messages .direct-chat-name {
            font-size: 15px;
            font-weight: 600;
            margin: 0 0 0 49px !important;
            color: #fff;
            opacity: 0.9;
        }

        .popup-messages .direct-chat-info {
            display: block;
            font-size: 12px;
            margin-bottom: 0;
        }

        .popup-messages .big-round {
            margin: -9px 0 0 !important;
        }

        .popup-messages .direct-chat-img {
            border: 1px solid #fff;
            background: #3f9684 none repeat scroll 0 0;
            border-radius: 50%;
            float: left;
            height: 40px;
            margin: -21px 0 0;
            width: 40px;
        }

        .direct-chat-reply-name {
            color: #fff;
            font-size: 15px;
            margin: 0 0 0 10px;
            opacity: 0.9;
        }

        .direct-chat-img-reply-small {
            border: 1px solid #fff;
            border-radius: 50%;
            float: left;
            height: 20px;
            margin: 0 8px;
            width: 20px;
            background: #3f9684;
        }

        .popup-messages .direct-chat-msg {
            margin-bottom: 10px;
            position: relative;
        }

        .popup-messages .doted-border::after {
            background: transparent none repeat scroll 0 0 !important;
            border-right: 2px dotted #fff !important;
            bottom: 0;
            content: "";
            left: 17px;
            margin: 0;
            position: absolute;
            top: 0;
            width: 2px;
            display: inline;
            z-index: -2;
        }

        .popup-messages .direct-chat-msg::after {
            background: #fff none repeat scroll 0 0;
            border-right: medium none;
            bottom: 0;
            content: "";
            left: 17px;
            margin: 0;
            position: absolute;
            top: 0;
            width: 2px;
            display: inline;
            z-index: -2;
        }

        .direct-chat-text::after,
        .direct-chat-text::before {

            border-color: transparent #dfece7 transparent transparent;

        }

        .direct-chat-text::after,
        .direct-chat-text::before {
            -moz-border-bottom-colors: none;
            -moz-border-left-colors: none;
            -moz-border-right-colors: none;
            -moz-border-top-colors: none;
            border-color: transparent #d2d6de transparent transparent;
            border-image: none;
            border-style: solid;
            border-width: medium;
            content: " ";
            height: 0;
            pointer-events: none;
            position: absolute;
            right: 100%;
            top: 15px;
            width: 0;
        }

        .direct-chat-text::after {
            border-width: 5px;
            margin-top: -5px;
        }

        .popup-messages .direct-chat-text {
            background: #dfece7 none repeat scroll 0 0;
            border: 1px solid #dfece7;
            border-radius: 2px;
            color: #1f2121;
        }

        .direct-chat-text {
            background: #d2d6de none repeat scroll 0 0;
            border: 1px solid #d2d6de;
            border-radius: 5px;
            color: #444;
            margin: 5px 0 0 50px;
            padding: 5px 10px;
            position: relative;
        }
    </style>

    <div class="slider-area">
        <!-- Slider -->

        <div class="block-slider block-slider4">
            <ul class="" id="bxslider-home4">
                @foreach ($product as $key => $value)
                    @if ($key < 3)
                        <li>
                            <img src="{{ asset($value->img) }}" alt="Slide">
                            <div class="caption-group">
                                <h2 class="caption title">
                                    {{ $value->name }}
                                </h2>
                                <h4 class="caption subtitle">{{ $value->subCategory->name }}</h4>
                                <a class="caption button-radius" href="{{ route('front.product.detail', $value->id) }}"><span
                                        class="icon"></span>Shop now</a>
                            </div>
                        </li>
                    @endif
                @endforeach
                {{-- <li><img src="img/h4-slide2.png" alt="Slide">
                    <div class="caption-group">
                        <h2 class="caption title">
                            by one, get one <span class="primary">50% <strong>off</strong></span>
                        </h2>
                        <h4 class="caption subtitle">school supplies & backpacks.*</h4>
                        <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
                    </div>
                </li>
                <li><img src="img/h4-slide3.png" alt="Slide">
                    <div class="caption-group">
                        <h2 class="caption title">
                            Apple <span class="primary">Store <strong>Ipod</strong></span>
                        </h2>
                        <h4 class="caption subtitle">Select Item</h4>
                        <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
                    </div>
                </li>
                <li><img src="img/h4-slide4.png" alt="Slide">
                    <div class="caption-group">
                        <h2 class="caption title">
                            Apple <span class="primary">Store <strong>Ipod</strong></span>
                        </h2>
                        <h4 class="caption subtitle">& Phone</h4>
                        <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
                    </div>
                </li> --}}
            </ul>
        </div>
        <!-- ./Slider -->
    </div> <!-- End slider area -->

    <div class="promo-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">

                <div class="col-md-4 col-sm-6">
                    <div class="single-promo promo2">
                        <i class="fa fa-truck"></i>
                        <p>Free shipping</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="single-promo promo3">
                        <i class="fa fa-lock"></i>
                        <p>Secure payments</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="single-promo promo4">
                        <i class="fa fa-gift"></i>
                        <p>New products</p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End promo area -->

    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Latest Products</h2>
                        <div class="product-carousel">
                            @foreach ($product as $value)
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="{{ asset($value->img) }}" alt="" style="height: 305px;">
                                        <div class="product-hover">
                                            <a href="{{ route('front.product.cart.add', $value->id) }}"
                                                class="add-to-cart-link"><i class="fa fa-shopping-cart"></i>
                                                Add
                                                to cart</a>
                                            <a href="{{ route('front.product.detail', $value->id) }}"
                                                class="view-details-link"><i class="fa fa-link"></i>
                                                See details</a>
                                        </div>
                                    </div>

                                    <h2><a href="single-product.html">{{ $value->name }}</a></h2>

                                    <div class="product-carousel-price">
                                        Rs <ins>{{ $value->sale_price }}</ins>
                                    </div>
                                </div>
                            @endforeach
                            {{-- <div class="single-product">
                                <div class="product-f-image">
                                    <img src="img/product-2.jpg" alt="">
                                    <div class="product-hover">
                                        <a href="#" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add
                                            to cart</a>
                                        <a href="single-product.html" class="view-details-link"><i class="fa fa-link"></i>
                                            See details</a>
                                    </div>
                                </div>

                                <h2>Nokia Lumia 1320</h2>
                                <div class="product-carousel-price">
                                    <ins>$899.00</ins> <del>$999.00</del>
                                </div>
                            </div>
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="img/product-3.jpg" alt="">
                                    <div class="product-hover">
                                        <a href="#" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add
                                            to cart</a>
                                        <a href="single-product.html" class="view-details-link"><i class="fa fa-link"></i>
                                            See details</a>
                                    </div>
                                </div>

                                <h2>LG Leon 2015</h2>

                                <div class="product-carousel-price">
                                    <ins>$400.00</ins> <del>$425.00</del>
                                </div>
                            </div>
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="img/product-4.jpg" alt="">
                                    <div class="product-hover">
                                        <a href="#" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i>
                                            Add to cart</a>
                                        <a href="single-product.html" class="view-details-link"><i class="fa fa-link"></i>
                                            See details</a>
                                    </div>
                                </div>

                                <h2><a href="single-product.html">Sony microsoft</a></h2>

                                <div class="product-carousel-price">
                                    <ins>$200.00</ins> <del>$225.00</del>
                                </div>
                            </div>
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="img/product-5.jpg" alt="">
                                    <div class="product-hover">
                                        <a href="#" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i>
                                            Add to cart</a>
                                        <a href="single-product.html" class="view-details-link"><i class="fa fa-link"></i>
                                            See details</a>
                                    </div>
                                </div>

                                <h2>iPhone 6</h2>

                                <div class="product-carousel-price">
                                    <ins>$1200.00</ins> <del>$1355.00</del>
                                </div>
                            </div>
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="img/product-6.jpg" alt="">
                                    <div class="product-hover">
                                        <a href="#" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i>
                                            Add to cart</a>
                                        <a href="single-product.html" class="view-details-link"><i
                                                class="fa fa-link"></i> See details</a>
                                    </div>
                                </div>

                                <h2><a href="single-product.html">Samsung gallaxy note 4</a></h2>

                                <div class="product-carousel-price">
                                    <ins>$400.00</ins>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End main content area -->

    {{--    <div class="product-widget-area"> --}}
    {{--        <div class="zigzag-bottom"></div> --}}
    {{--        <div class="container"> --}}
    {{--            <div class="row"> --}}
    {{--                <div class="col-md-4"> --}}
    {{--                    <div class="single-product-widget"> --}}
    {{--                        <h2 class="product-wid-title">Top Sellers</h2> --}}
    {{--                        <a href="" class="wid-view-more">View All</a> --}}
    {{--                        <div class="single-wid-product"> --}}
    {{--                            <a href="single-product.html"><img src="img/product-thumb-1.jpg" alt="" --}}
    {{--                                    class="product-thumb"></a> --}}
    {{--                            <h2><a href="single-product.html">Sony Smart TV - 2015</a></h2> --}}
    {{--                            <div class="product-wid-rating"> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                            </div> --}}
    {{--                            <div class="product-wid-price"> --}}
    {{--                                <ins>$400.00</ins> <del>$425.00</del> --}}
    {{--                            </div> --}}
    {{--                        </div> --}}
    {{--                        <div class="single-wid-product"> --}}
    {{--                            <a href="single-product.html"><img src="img/product-thumb-2.jpg" alt="" --}}
    {{--                                    class="product-thumb"></a> --}}
    {{--                            <h2><a href="single-product.html">Apple new mac book 2015</a></h2> --}}
    {{--                            <div class="product-wid-rating"> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                            </div> --}}
    {{--                            <div class="product-wid-price"> --}}
    {{--                                <ins>$400.00</ins> <del>$425.00</del> --}}
    {{--                            </div> --}}
    {{--                        </div> --}}
    {{--                        <div class="single-wid-product"> --}}
    {{--                            <a href="single-product.html"><img src="img/product-thumb-3.jpg" alt="" --}}
    {{--                                    class="product-thumb"></a> --}}
    {{--                            <h2><a href="single-product.html">Apple new i phone 6</a></h2> --}}
    {{--                            <div class="product-wid-rating"> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                            </div> --}}
    {{--                            <div class="product-wid-price"> --}}
    {{--                                <ins>$400.00</ins> <del>$425.00</del> --}}
    {{--                            </div> --}}
    {{--                        </div> --}}
    {{--                    </div> --}}
    {{--                </div> --}}
    {{--                <div class="col-md-4"> --}}
    {{--                    <div class="single-product-widget"> --}}
    {{--                        <h2 class="product-wid-title">Recently Viewed</h2> --}}
    {{--                        <a href="#" class="wid-view-more">View All</a> --}}
    {{--                        <div class="single-wid-product"> --}}
    {{--                            <a href="single-product.html"><img src="img/product-thumb-4.jpg" alt="" --}}
    {{--                                    class="product-thumb"></a> --}}
    {{--                            <h2><a href="single-product.html">Sony playstation microsoft</a></h2> --}}
    {{--                            <div class="product-wid-rating"> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                            </div> --}}
    {{--                            <div class="product-wid-price"> --}}
    {{--                                <ins>$400.00</ins> <del>$425.00</del> --}}
    {{--                            </div> --}}
    {{--                        </div> --}}
    {{--                        <div class="single-wid-product"> --}}
    {{--                            <a href="single-product.html"><img src="img/product-thumb-1.jpg" alt="" --}}
    {{--                                    class="product-thumb"></a> --}}
    {{--                            <h2><a href="single-product.html">Sony Smart Air Condtion</a></h2> --}}
    {{--                            <div class="product-wid-rating"> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                            </div> --}}
    {{--                            <div class="product-wid-price"> --}}
    {{--                                <ins>$400.00</ins> <del>$425.00</del> --}}
    {{--                            </div> --}}
    {{--                        </div> --}}
    {{--                        <div class="single-wid-product"> --}}
    {{--                            <a href="single-product.html"><img src="img/product-thumb-2.jpg" alt="" --}}
    {{--                                    class="product-thumb"></a> --}}
    {{--                            <h2><a href="single-product.html">Samsung gallaxy note 4</a></h2> --}}
    {{--                            <div class="product-wid-rating"> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                            </div> --}}
    {{--                            <div class="product-wid-price"> --}}
    {{--                                <ins>$400.00</ins> <del>$425.00</del> --}}
    {{--                            </div> --}}
    {{--                        </div> --}}
    {{--                    </div> --}}
    {{--                </div> --}}
    {{--                <div class="col-md-4"> --}}
    {{--                    <div class="single-product-widget"> --}}
    {{--                        <h2 class="product-wid-title">Top New</h2> --}}
    {{--                        <a href="#" class="wid-view-more">View All</a> --}}
    {{--                        <div class="single-wid-product"> --}}
    {{--                            <a href="single-product.html"><img src="img/product-thumb-3.jpg" alt="" --}}
    {{--                                    class="product-thumb"></a> --}}
    {{--                            <h2><a href="single-product.html">Apple new i phone 6</a></h2> --}}
    {{--                            <div class="product-wid-rating"> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                            </div> --}}
    {{--                            <div class="product-wid-price"> --}}
    {{--                                <ins>$400.00</ins> <del>$425.00</del> --}}
    {{--                            </div> --}}
    {{--                        </div> --}}
    {{--                        <div class="single-wid-product"> --}}
    {{--                            <a href="single-product.html"><img src="img/product-thumb-4.jpg" alt="" --}}
    {{--                                    class="product-thumb"></a> --}}
    {{--                            <h2><a href="single-product.html">Samsung gallaxy note 4</a></h2> --}}
    {{--                            <div class="product-wid-rating"> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                            </div> --}}
    {{--                            <div class="product-wid-price"> --}}
    {{--                                <ins>$400.00</ins> <del>$425.00</del> --}}
    {{--                            </div> --}}
    {{--                        </div> --}}
    {{--                        <div class="single-wid-product"> --}}
    {{--                            <a href="single-product.html"><img src="img/product-thumb-1.jpg" alt="" --}}
    {{--                                    class="product-thumb"></a> --}}
    {{--                            <h2><a href="single-product.html">Sony playstation microsoft</a></h2> --}}
    {{--                            <div class="product-wid-rating"> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                                <i class="fa fa-star"></i> --}}
    {{--                            </div> --}}
    {{--                            <div class="product-wid-price"> --}}
    {{--                                <ins>$400.00</ins> <del>$425.00</del> --}}
    {{--                            </div> --}}
    {{--                        </div> --}}
    {{--                    </div> --}}
    {{--                </div> --}}
    {{--            </div> --}}
    {{--        </div> --}}
    {{--    </div> --}}
    {{--    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}

    {{--    <!------ Include the above in your HEAD tag ----------> --}}

    {{--    <div class="container text-center"> --}}
    {{--        <div class="row"> --}}
    {{--            <h2 st>Open in chat (popup-box chat-popup)</h2> --}}
    {{--            <h4>Click Here</h4> --}}


    {{--            <hr> --}}

    {{--            MORE : --}}
    {{--            <a target="_blank" href="http://bootsnipp.com/snippets/33ejn">Whatsapp Chat Box POPUP</a>, --}}
    {{--            <a target="_blank" href="http://bootsnipp.com/snippets/z4P39"> Creative User Profile  </a> --}}

    {{--        </div> --}}
    {{--    </div> --}}



    <!-- End product widget area -->
@endsection
