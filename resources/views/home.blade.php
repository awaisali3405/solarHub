@extends('front.layouts.app')
@section('content')
    <section id="slider">
        <!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>

                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="col-sm-6">
                                    <h1><span>SOLAR</span> HUB</h1>

                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{ asset('images/home/girl1.jpg') }}" width="237" height="256"
                                        class="girl img-responsive" alt="" />
                                    {{-- <img src="{{ asset('images/home/pricing.png') }}" class="pricing" alt="" /> --}}
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>SOLAR</span> HUB</h1>

                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{ asset('images/home/girl2.jpg') }}" width="237" height="256"
                                        class="girl img-responsive" alt="" />
                                    {{-- <img src="{{ asset('images/home/pricing.png') }}" class="pricing" alt="" /> --}}
                                </div>
                            </div>

                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>SOLAR</span> HUB</h1>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{ asset('images/home/girl3.jpg') }}" width="237" height="256"
                                        class="girl img-responsive" alt="" />
                                    {{-- <img src="{{ asset('images/home/pricing.png') }}" class="pricing" alt="" /> --}}
                                </div>
                            </div>

                        </div>

                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--/slider-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Category</h2>
                        <div class="panel-group category-products" id="accordian">
                            <!--category-productsr-->
                            @foreach ($category as $value)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">

                                                @if (count($value->subCategory) > 0)
                                                    <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                                @endif
                                            </a>
                                            <a href="{{ route('front.category.product', $value->id) }}">

                                                {{ $value->name }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="sportswear" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul>
                                                @foreach ($value->subCategory as $value2)
                                                    <li><a href="{{ route('front.subCategory.product', $value2->id) }}">{{ $value2->name }}
                                                        </a></li>
                                                @endforeach

                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            @endforeach




                        </div>

                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="features_items">
                        <!--features_items-->
                        <h2 class="title text-center">Features Items</h2>
                        @foreach ($products as $value)
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ asset($value->img) }}" width="237" height="256"
                                                alt="" />
                                            <h2>Rs.{{ $value->sale_price }}</h2>
                                            <p>{{ $value->name }}</p>
                                            <a href="{{ route('front.product.cart.add', $value->id) }}"
                                                class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                                                to cart</a>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>Rs.{{ $value->sale_price }}</h2>
                                                <p>{{ $value->price }}</p>
                                                <a href="{{ route('front.product.cart.add', $value->id) }}"
                                                    class="btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach


                    </div>
                    <!--features_items-->

                    <div class="category-tab">
                        <!--category-tab-->
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                @foreach ($category as $key => $value)
                                    <li class=" {{ $key == 0 ? 'active' : '' }}"><a href="#{{ $value->name }}"
                                            data-toggle="tab">{{ $value->name }}</a></li>
                                @endforeach

                            </ul>
                        </div>

                        <div class="tab-content">
                            @foreach ($category as $value)
                                <div class="tab-pane fade active in" id="{{ $value->name }}">
                                    @foreach ($value->products as $value2)
                                        <a href="{{ route('front.product.detail', $value2->id) }}">

                                            <div class="col-sm-3">
                                                <div class="product-image-wrapper">
                                                    <div class="single-products">
                                                        <div class="productinfo text-center">
                                                            <img src="{{ asset($value2->img) }}" alt="" />
                                                            <h2>Rs.{{ $value2->sale_price }}</h2>
                                                            <p>{{ $value2->name }}</p>
                                                            <a href="{{ route('front.product.cart.add', $value->id) }}"
                                                                class="btn btn-default add-to-cart"><i
                                                                    class="fa fa-shopping-cart"></i>Add to cart</a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                </div>
                            @endforeach
                            @endforeach


                        </div>
                    </div>
                    <!--/category-tab-->
                    @if (Auth::check())
                        <div class="recommended_items">
                            <!--recommended_items-->
                            <h2 class="title text-center">Recommended Items</h2>

                            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($rec as $value)
                                        <div class="item active">

                                            <div class="col-sm-4">
                                                <div class="product-image-wrapper">
                                                    <div class="single-products">
                                                        <div class="productinfo text-center">
                                                            <img src="{{ asset($value->img) }}" style="width: 70%;"
                                                                alt="" />
                                                            <h2>Rs.{{ $value->sale_price }}</h2>
                                                            <p>{{ $value->name }}</p>
                                                            <a href="{{ route('front.product.cart.add', $value->id) }}"
                                                                class="btn btn-default add-to-cart"><i
                                                                    class="fa fa-shopping-cart"></i>Add to cart</a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                                <a class="left recommended-item-control" href="#recommended-item-carousel"
                                    data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="right recommended-item-control" href="#recommended-item-carousel"
                                    data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                    <!--/recommended_items-->

                </div>
            </div>
        </div>
    </section>
@endsection
