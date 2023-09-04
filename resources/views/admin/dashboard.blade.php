@extends('admin.layouts.app')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <div class="home-tab">

                        <div class="tab-content tab-content-basic">
                            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="statistics-details d-flex align-items-center justify-content-between">
                                            <div>
                                                <p class="statistics-title">Daily Sale</p>
                                                <h3 class="rate-percentage">{{ $daily_sales }}</h3>
                                                <p class="text-danger d-flex"></p>
                                            </div>
                                            <div>
                                                <p class="statistics-title">Daily Purchase</p>
                                                <h3 class="rate-percentage">{{ $daily_purchase }}</h3>

                                            </div>
                                            <div>
                                                <p class="statistics-title">Daily Profit</p>
                                                <h3 class="rate-percentage">{{ $daily_sales - $daily_purchase }}</h3>

                                            </div>
                                            <div class="d-none d-md-block">
                                                <p class="statistics-title">Supplier</p>
                                                <h3 class="rate-percentage">{{ $supplier }}</h3>

                                            </div>
                                            <div class="d-none d-md-block">
                                                <p class="statistics-title">Customer</p>
                                                <h3 class="rate-percentage">{{ $customer }}</h3>

                                            </div>
                                            <div class="d-none d-md-block">
                                                <p class="statistics-title">Product</p>
                                                <h3 class="rate-percentage">{{ $product }}</h3>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 d-flex flex-column">
                                        <div class="row flex-grow">
                                            <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                                                <div class="card card-rounded">
                                                    <div class="card-body">

                                                        {!! $chart->container() !!}

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-12 d-flex flex-column">
                                        <div class="row flex-grow">
                                            <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                                                <div class="card card-rounded">
                                                    <div class="card-body">

                                                        {!! $orderChart->container() !!}

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
    <script src="{{ $orderChart->cdn() }}"></script>
    {{ $orderChart->script() }}
@endsection
