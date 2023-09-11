@extends('front.layouts.app')
@section('content')
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="product-content-right">
                        <div class="woocommerce  " style="display: flex; justify-content: center;">

                            <form action="{{ route('front.calculate.watt') }}" method="POST" enctype="multipart/form-data"
                                class="household_form" style="display:none;">

                                @csrf
                                <section id="cart_items">
                                    <div class="container">
                                        <div class="breadcrumbs">
                                            <ol class="breadcrumb">
                                                <li><a href="/">Home</a></li>
                                                <li class="active">Household Calculator</li>
                                            </ol>
                                        </div>
                                        {{-- asaas {!! __(session()->get('success')) !!} --}}
                                        <div class="table-responsive cart_info household_form"
                                            style="width: 50%; margin-left: 20%; ">
                                            <table class="table table-condensed">
                                                <thead>
                                                    <tr class="cart_menu">
                                                        <th class="price text-center">Accessories</th>
                                                        <th class="price text-center">Quantity</th>
                                                        <th class="price text-center">Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody class=" addRow">

                                                    <tr class="d-flex justify-content-center pb-2">
                                                        <td class="justify-content-center" style="margin-left:20%"><select
                                                                name="accessories[]" class="form-control " required
                                                                id="">
                                                                <option value="">Select accessories</option>
                                                                @foreach ($accessories as $value)
                                                                    <option value="{{ $value->id }}">{{ $value->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select></td>
                                                        <td class="text-center"
                                                            style="display: flex; justify-content: center;">
                                                            <input type="number" name="quantity[]" id=""
                                                                class=" form-control" required style="width: 20%">
                                                        </td>
                                                        <td class="text-center"><span class="add btn btn "><i
                                                                    class="fa fa-plus"></i></span>
                                                        </td>
                                                    </tr>





                                                </tbody>
                                                <thead>
                                                    <tr>
                                                        <td colspan="4" class="text-center"><button
                                                                class="btn btn-primary" type="submit">Calculate</button>
                                                        </td>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </section>
                                {{-- asaas {!! __(session()->get('success')) !!} --}}


                            </form>
                            <form action="{{ route('front.calculate.industrial.watt') }}" method="POST"
                                class="industrial_form" style=" display:none;" enctype="multipart/form-data">

                                @csrf
                                <section id="cart_items">
                                    <div class="container">
                                        <div class="breadcrumbs">
                                            <ol class="breadcrumb">
                                                <li><a href="/">Home</a></li>
                                                <li class="active">Industrail calculator</li>
                                            </ol>
                                        </div>
                                        {{-- asaas {!! __(session()->get('success')) !!} --}}
                                        <div class="table-responsive cart_info " style="width: 50%; margin-left: 20%;">
                                            <table class="table table-condensed">
                                                <thead>
                                                    <tr class="cart_menu">
                                                        <th class="price text-center">Monthly Unit</th>
                                                        <th class="price text-center">Daily Working Hour</th>


                                                    </tr>
                                                </thead>
                                                <tbody class=" addRow">

                                                    <tr class="d-flex justify-content-center pb-2">
                                                        <td class="justify-content-center" style="margin-left:40%"><input
                                                                type="number" name="monthly_unit" id=""
                                                                class=" form-control" required
                                                                style="width: 40%; margin-left:30%"></td>
                                                        <td class="text-center"
                                                            style="display: flex; justify-content: center;">
                                                            <input type="number" name="monthly_hour" id=""
                                                                class=" form-control" required style="width: 40%">
                                                        </td>

                                                    </tr>





                                                </tbody>
                                                <thead>
                                                    <tr>
                                                        <td colspan="4" class="text-center"><button
                                                                class="btn btn-primary" type="submit">Calculate</button>
                                                        </td>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </section>
                                {{-- asaas {!! __(session()->get('success')) !!} --}}


                            </form>


                        </div>
                        <div class="single-product-area packages"
                            style="background-color: #fbfbfb; border-radius: 20px; padding-bottom:5%; padding-top:5%; margin-bottom: 5%;">

                            <div class="container">
                                <div class="row " style="display: flex; justify-content: center;">

                                    <div class="col-md-4 col-sm-8">
                                        <div class="single-shop-product"
                                            style="background-color: rgba(221, 221, 221, 0.644); border-radius: 20px; padding-right: 20px;">
                                            <div class="product-upper text-center" style="padding:1rem 1rem 1rem 1rem;">
                                                <h2>Industrial Project</h2>
                                            </div>
                                            <h4>
                                                <ul>
                                                    <li>Calculate by the unit</li>
                                                </ul>
                                            </h4>

                                            <div class="product-option-shop"
                                                style="display: flex; justify-content: center;  padding:1rem 1rem 1rem 1rem;">


                                                <span class="btn btn-primary industrial">Select</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-8">
                                        <div class="single-shop-product"
                                            style="background-color: rgba(221, 221, 221, 0.644); border-radius: 20px; padding-right: 20px;">
                                            <div class="product-upper text-center" style="padding:1rem 1rem 1rem 1rem;">
                                                <h2>Household Project</h2>
                                            </div>
                                            <h4>
                                                <ul>
                                                    <li>Calculate by adding accessories</li>

                                                </ul>
                                            </h4>

                                            <div class="product-option-shop"
                                                style="display: flex; justify-content: center;  padding:1rem 1rem 1rem 1rem;">

                                                <span for="basic" class="btn btn-primary household">Select</s>
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
        $('.add').on('click', function() {
            console.log('adsa')
            html = `<tr class="d-flex justify-content-center">
                                        <td class=""><select name="accessories[]" class="form-control " required
                                                id="">
                                                <option value="">Select accessories</option>
                                                @foreach ($accessories as $value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            </select></td>
                                        <td class="" style="display: flex; justify-content: center;"><input type="number" name="quantity[]" id=""
                                                                class=" form-control" required style="width: 20%"></td>
                                                                <td class="text-center"><span class="remove btn btn "><i
                                                                    class="fa fa-minus"></i></span>
                                                        </td>
                                    </tr>`
            $('.addRow').append(html);

        });
        $('.addRow').on('click', '.remove', function() {
            $(this).parent().parent().remove();
        });
        $('.industrial').on('click', function() {
            $('.industrial_form').show();
            $('.packages').hide();

        })
        $('.household').on('click', function() {
            $('.household_form').show();
            $('.packages').hide();

        })
    </script>
@endsection
