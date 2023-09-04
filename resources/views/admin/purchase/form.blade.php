@extends('admin.layouts.app')

@section('content')
    <section class="main-panel">
        <div class="content-wrapper">
            @include('admin.common.breadcrumbs')
            <div class="row">
                <label style="font-weight: 700; font-size: 20px; text-align: center;">{{ $pageHeading }}</label>
                <div class="col-12 col-sm-12 col-md-6 mt-2 offset-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $pageHeading }} From</h4>
                        </div>
                        <div class="card-body">
                            <form id="cart" action="{{ $action }}" method="post" enctype="multipart/form-data">

                                @csrf
                                <input type="hidden" value="PUT" name="_method">
                                <div class="row text-center mx-auto">
                                    <div class="col-xl-3 mt-2">
                                        <div class="form-group " style="display: inline;">
                                            <input type="text" class="form-control" name="unique_id" id="unique"
                                                placeholder="Bill No" value="3" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-xl-3 mt-2">
                                        <div class="form-group mx-3">
                                            <select class="form-control " name="supplier_id" id="name_suppler"
                                                required="">
                                                <option value="">Select</option>
                                                @foreach ($supplier as $value)
                                                    <option value={{ $value->id }}
                                                        {{ $value->id == $purchase->supplier_id ? 'selected' : '' }}>
                                                        {{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>



                                </div><br>
                                <table name="cart table  responsive text-center">

                                    <tbody class="products">
                                        <tr style="margin-bottom: 20px;">
                                            <td colspan="99" class="mb-3"><span
                                                    class="row-add btn btn-primary px-3 float-end"
                                                    id="add_purchase_product">Add
                                                </span></td>
                                        </tr>
                                        <tr class="mt-5">
                                            <td></td>
                                            <th><label for=""> Product_Name</label></th>
                                            <th><label for="">Quantity</label></th>
                                            <th>Price</th>
                                            <th></th>
                                            <th style=" margin-left:20px"><label for=""> Total_Price</label></th>
                                        </tr>
                                        {{-- </tbody>
                                    <tbody class="product"> --}}

                                    <tbody class="product">
                                        @forelse ($purchase->product as $key=>$value)
                                            <tr class="line_items text-center item" style="margin-top:5px;">
                                                <td><span class="row-remove btn btn-danger {{ $key == 1 ? 'd-none' : '' }}"
                                                        style=" margin-right:20px">Remove</span></td>
                                                <input type="hidden" value="{{ $value->id }}" id="row_id">
                                                <td> <select class="form-control product_name" style="margin-top: 11px;"
                                                        name="product_id[]" required>
                                                        <option value="">Select Product</option>
                                                        @foreach ($product as $value2)
                                                            <option value="{{ $value2->id }}"
                                                                {{ $value2->id == $value->product_id ? 'selected' : '' }}>
                                                                {{ $value2->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>


                                                <td><input type="number" step="any"
                                                        class="form-control product_quantity" style="    margin-top: 11px;"
                                                        name="quantity[]" value="{{ $value->quantity }}"></td>
                                                <td><input type="number" step="any" class="form-control product_price"
                                                        style="    margin-top: 11px;" name="price[]"
                                                        value="{{ $value->price }}"></td>
                                                <td></td>
                                                <td><input type="text" class="form-control product_total_price"
                                                        style="    margin-top: 11px;" name="item_total[]"
                                                        value="{{ $value->quantity * $value->price }}" readonly>
                                                </td>
                                            </tr>
                                        @empty

                                            <tr class="line_items text-center" style="margin-top:5px;">
                                                <td><span class="row-remove btn btn-danger d-none   "
                                                        style=" margin-right:20px">Remove</span></td>
                                                <td> <select class="form-control product_name" style="margin-top: 11px;"
                                                        name="product_id[]" required>
                                                        <option value="">Select Product</option>
                                                        @foreach ($product as $value2)
                                                            <option value="{{ $value2->id }}">
                                                                {{ $value2->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>


                                                <td><input type="number" step="any"
                                                        class="form-control product_quantity" style="    margin-top: 11px;"
                                                        name="quantity[]" value=""></td>
                                                <td><input type="number" step="any" class="form-control product_price"
                                                        style="    margin-top: 11px;" name="price[]" value=""></td>
                                                <td></td>
                                                <td><input type="text" class="form-control product_total_price"
                                                        style="    margin-top: 11px;" name="item_total[]" value=""
                                                        readonly>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>

                                    <tr>
                                        <td colspan="3"></td>
                                        <th><label for="">Total</label></th>
                                        <td></td>
                                        <td><input type="text" class="form-control" id="sub" name="sub_total"
                                                readonly value=""></td>
                                    </tr>

                                    <tr>
                                        <td colspan="3"></td>
                                        <th><label for="">Discount Total</label></th>
                                        <td></td>
                                        <td> <input type="text" name="discount" id="discount_total"
                                                class="form-control" value=""
                                                jautocalc="({sub_total}-({sub_total} * {discount})/100)"
                                                readonly="readonly" _jautocalc="_jautocalc"></td>
                                    </tr>

                                    <tr>
                                        <td colspan="3"></td>
                                        <th><label for="">GST Total</label></th>
                                        <td></td>
                                        <td> <input type="text" name="" id="gst_total" class="form-control"
                                                value="" jautocalc="({gtotal}+({gtotal} * {gst})/100)"
                                                readonly="readonly" _jautocalc="_jautocalc"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <th><label for="">Grand Total</label></th>
                                        <td></td>
                                        <td> <input type="text" name="total" id="grandtotal" class="form-control"
                                                value="{{ $purchase->total }}"
                                                jautocalc="({ftotal}+({ftotal} * {wht})/100)" readonly="readonly"
                                                _jautocalc="_jautocalc"></td>
                                    </tr>

                                    <tr>
                                        <td colspan="3"></td>
                                        <th><label for="">Remaining</label></th>
                                        <td></td>
                                        <td> <input type="text" name="" id="rempay" class="form-control"
                                                value="{{ $purchase->total - $purchase->paid }}"
                                                jautocalc="({grandtotal} - {paid_unpaid})" readonly="readonly"
                                                _jautocalc="_jautocalc"></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="fw-bold">Discount
                                                %</label>
                                            <input type="number" step="any" name="discount" id="discount"
                                                value="{{ $purchase->discount }}" class="form-control"
                                                style="margin-left:20px;">
                                        </td>

                                        <td>
                                            <label class="fw-bold">GST
                                                Tax %</label>
                                            <input type="number" step="any" name="gst_tax" id="gst"
                                                value="{{ $purchase->gst_tax }}" class="form-control"
                                                style="margin-left:30px;">
                                        </td>
                                        <td>
                                            <label class="fw-bold">
                                                WHT Tax %</label>
                                            <input type="number" step="any" name="wht_tax" id="wht"
                                                value="{{ $purchase->wht_tax }}" class="form-control"
                                                style="margin-left:35px;">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <br>
                                            <label class="fw-bold"> Payment Status</label>
                                            <select class="form-control mx-auto" name="status" id="status_id"
                                                required="">
                                                <option value="unpaid"
                                                    {{ $purchase->status == 'unpaid' ? 'selected' : '' }}>
                                                    UnPaid
                                                </option>
                                                <option value="paid"
                                                    {{ $purchase->status == 'paid' ? 'selected' : '' }}>
                                                    Paid
                                                </option>

                                            </select>
                                        </td>

                                        <td>
                                            <br>
                                            <label class="fw-bold">Enter Amount if paid</label>
                                            <input type="number" step="any" class="form-control mx-2"
                                                name="paid" id="paid_id" placeholder="Enter Amount if paid" 
                                                value="{{ $purchase->paid }}">
                                        </td>

                                    </tr>


                                    <tr>
                                        <td colspan="99"><button type="submit" style=" margin-top: 16px;"
                                                class="btn btn-success p-2">Submit </button></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
