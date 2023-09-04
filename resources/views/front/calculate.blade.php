@extends('front.layouts.app')
@section('content')
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="product-content-right">
                        <div class="woocommerce  " style="display: flex; justify-content: center;">
                            <form action="{{ route('front.calculate.watt') }}" method="POST" enctype="multipart/form-data">

                                @csrf
                                {{-- asaas {!! __(session()->get('success')) !!} --}}
                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                        <tr>

                                            <th class="product-name">Accessories</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="addRow">
                                        {{-- {{ dd($cart) }} --}}
                                        <tr class="d-flex justify-content-center">
                                            <td class=""><select name="accessories[]" class="form-control " required
                                                    id="">
                                                    <option value="">Select accessories</option>
                                                    @foreach ($accessories as $value)
                                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                </select></td>
                                            <td class="" style="display: flex; justify-content: center;"><input
                                                    type="number" name="quantity[]" id="" class=" form-control"
                                                    required style="width: 50%"></td>
                                            <td class=""><span class="add btn btn "><i class="fas fa-plus"></i></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th colspan="3"> <button type="submit" class="btn">Calculate</button>
                                            </th>
                                        </tr>
                                    </thead>
                                </table>

                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.add').on('click', function() {

            html = `<tr class="d-flex justify-content-center">
                                        <td class=""><select name="accessories[]" class="form-control " required
                                                id="">
                                                <option value="">Select accessories</option>
                                                @foreach ($accessories as $value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            </select></td>
                                        <td class="" style="display: flex; justify-content: center;"><input
                                                type="number" name="quantity[]" id="" class=" form-control"
                                                style="width: 50%" requried></td>
                                        <td class=""><span class="remove btn btn "><i class="fas fa-minus"></i></span>
                                        </td>
                                    </tr>`
            $('.addRow').append(html);

        });
        $('.addRow').on('click', '.remove', function() {
            $(this).parent().parent().remove();
        });
    </script>
@endsection
