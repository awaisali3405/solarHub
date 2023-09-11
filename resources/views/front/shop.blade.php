@extends('front.layouts.app')
@section('content')
    {{-- <section id="advertisement">
        <div class="container">
            <img src="images/shop/advertisement.jpg" alt="" />
        </div>
    </section> --}}

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
                        @foreach ($product as $value)
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
                        @if ($product->lastPage() > 1)
                            <ul class="pagination">
                                <li class="{{ $product->currentPage() == 1 ? ' disabled' : '' }}">
                                    <a href="{{ $product->url(1) }}">Previous</a>
                                </li>
                                @for ($i = 1; $i <= $product->lastPage(); $i++)
                                    <li class="{{ $product->currentPage() == $i ? ' active' : '' }}">
                                        <a href="{{ $product->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="{{ $product->currentPage() == $product->lastPage() ? ' disabled' : '' }}">
                                    <a href="{{ $product->url($product->currentPage() + 1) }}">Next</a>
                                </li>
                            </ul>
                        @endif

                    </div>
                    <!--features_items-->
                </div>
            </div>
        </div>
    </section>
@endsection
