@extends('front.layouts.app')
@section('content')
    <style>
        .rating {
            display: flex;
            float: left;
            flex-direction: row-reverse;
            gap: 0.3rem;
            --stroke: #666;
            --fill: #ffc73a;
        }

        .rating input {
            appearance: unset;
        }

        .rating label {
            cursor: pointer;
        }

        .rating svg {
            width: 3rem;
            height: 3rem;
            overflow: visible;
            fill: transparent;
            stroke: var(--stroke);
            stroke-linejoin: bevel;
            stroke-dasharray: 12;
            animation: idle 4s linear infinite;
            transition: stroke 0.2s, fill 0.5s;
        }

        @keyframes idle {
            from {
                stroke-dashoffset: 24;
            }
        }

        .rating label:hover svg {
            stroke: var(--fill);
        }

        .rating input:checked~label svg {
            transition: 0s;
            animation: idle 4s linear infinite, yippee 0.75s backwards;
            fill: var(--fill);
            stroke: var(--fill);
            stroke-opacity: 0;
            stroke-dasharray: 0;
            stroke-linejoin: miter;
            stroke-width: 8px;
        }

        @keyframes yippee {
            0% {
                transform: scale(1);
                fill: var(--fill);
                fill-opacity: 0;
                stroke-opacity: 1;
                stroke: var(--stroke);
                stroke-dasharray: 10;
                stroke-width: 1px;
                stroke-linejoin: bevel;
            }

            30% {
                transform: scale(0);
                fill: var(--fill);
                fill-opacity: 0;
                stroke-opacity: 1;
                stroke: var(--stroke);
                stroke-dasharray: 10;
                stroke-width: 1px;
                stroke-linejoin: bevel;
            }

            30.1% {
                stroke: var(--fill);
                stroke-dasharray: 0;
                stroke-linejoin: miter;
                stroke-width: 8px;
            }

            60% {
                transform: scale(1.2);
                fill: var(--fill);
            }
        }
    </style>
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
                                                {{ $value->name }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="sportswear" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul>
                                                @foreach ($value->subCategory as $value2)
                                                    <li><a href="">{{ $value2->name }} </a></li>
                                                @endforeach

                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                            <!--/shipping-->

                        </div>
                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="product-details">
                        <!--product-details-->
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img src="{{ asset($product->img) }}" alt="" />
                            </div>


                        </div>
                        <div class="col-sm-7">
                            <div class="product-information">
                                <!--/product-information-->
                                <h2>{{ $product->name }}</h2>
                                {{-- <p>Product ID</p> --}}
                                @for ($i = 0; $i < $product->avgRating(); $i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                                <span class="" style="display: flex;">
                                    <span>Rs.{{ $product->sale_price }}</span>
                                    <label>Quantity:</label>
                                    <form action="{{ route('front.product.cart.add.quantity') }}" method="POST"
                                        class="">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                                        <input type="text" name="quantity" value="0" />
                                        <button type="submit" class="btn btn-fefault cart">
                                            <i class="fa fa-shopping-cart"></i>
                                            Add to cart
                                        </button>
                                    </form>
                                </span>
                                <p><b>Availability:</b>{{ $product->stock > 0 ? 'In Stock' : '' }} </p>
                                <p><b>Brand:</b> Solar Hub</p>
                            </div>
                            <!--/product-information-->
                        </div>
                    </div>

                    <div class="category-tab shop-details-tab">
                        <!--category-tab-->
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <li><a href="#details" data-toggle="tab">Details</a></li>

                                <li class="active"><a href="#reviews" data-toggle="tab">Reviews
                                        ({{ $product->feedback->count() }})</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade" id="details">
                                @foreach ($detail as $value)
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{ asset($value->img) }}" alt="" width="84"
                                                        height="85" />
                                                    <h2>Rs.{{ $value->sale_price }}</h2>
                                                    <p>{{ $value->name }}</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i
                                                            class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>





                            <div class="tab-pane fade active in" id="reviews">
                                <div class="col-sm-12">
                                    @foreach ($product->feedback as $value)
                                        <ul>
                                            <li><a href=""><i class="fa fa-user"></i>{{ $value->user->name }}</a>
                                            </li>
                                            <li><a href=""><i
                                                        class="fa fa-clock-o"></i>{{ $value->created_at->format('h:i a') }}</a>
                                            </li>
                                            <li><a href=""><i
                                                        class="fa fa-calendar-o"></i>{{ $value->created_at->toDateString() }}</a>
                                            </li>
                                            <li>
                                                @for ($i = 0; $i < $value->rating; $i++)
                                                    <i class="fa fa-star"></i>
                                                @endfor
                                            </li>
                                        </ul>
                                        <p>{{ $value->feedback }}</p>
                                    @endforeach

                                    {{-- @endif --}}
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--/category-tab-->

                    {{-- <div class="recommended_items">
                        <!--recommended_items-->
                        <h2 class="title text-center">recommended items</h2>

                        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="item active">
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="images/home/recommend1.jpg" alt="" />
                                                    <h2>Rs.1000</h2>
                                                    <p>Solar Panel</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i
                                                            class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="images/home/recommend2.jpg" alt="" />
                                                    <h2>Rs.1000</h2>
                                                    <p>Solar Panel</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i
                                                            class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="images/home/recommend3.jpg" alt="" />
                                                    <h2>Rs.1000</h2>
                                                    <p>Solar Panel</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i
                                                            class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="images/home/recommend1.jpg" alt="" />
                                                    <h2>Rs.1000</h2>
                                                    <p>Solar Panel</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i
                                                            class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="images/home/recommend2.jpg" alt="" />
                                                    <h2>Rs.1000</h2>
                                                    <p>Solar Panel</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i
                                                            class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="images/home/recommend3.jpg" alt="" />
                                                    <h2>Rs.1000</h2>
                                                    <p>Solar Panel</p>
                                                    <button type="button" class="btn btn-default add-to-cart"><i
                                                            class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right recommended-item-control" href="#recommended-item-carousel"
                                data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div> --}}
                    <!--/recommended_items-->

                </div>
            </div>
        </div>
    </section>
@endsection
