@extends('admin.layouts.app')
@push('style-page-level')
@endpush
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
                            <form class="form form-vertical" action="{{ $action }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="PUT" name="_method">
                                <div class="mb-3">
                                    <label for="name" style="margin-bottom: 10px;">Name</label>
                                    <input type="text" id="name" class="form-control" name="name"
                                        value="{{ old('name', $product->name) }}" placeholder="Enter Name" required>

                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>

                                <div class="">

                                    <div class="mb-3">
                                        <label for="value" style="margin-bottom: 10px;">Category</label>
                                        <select class="form-control" name="category_id">
                                            {{-- <option value="1" selected></option> --}}
                                            <option value="">----Select Category----</option>
                                            @foreach ($category as $key => $value)
                                                <option value="{{ $value->id }}"
                                                    {{ $value->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                                                    {{ ucfirst($value->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="value" style="margin-bottom: 10px;">Sub Category</label>
                                    <select class="form-control" name="sub_category_id">
                                        <option value="">----Select Sub Category----</option>
                                        @foreach ($subCategory as $key => $value)
                                            <option value="{{ $value->id }}"
                                                {{ $value->id == old('sub_category_id', $product->sub_category_id) ? 'selected' : '' }}>
                                                {{ ucfirst($value->name) }}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="mb-3">
                                    <label for="value" style="margin-bottom: 10px;">Unit</label>
                                    <select class="form-control" name="unit_id" required>
                                        <option value="">----Select Unit----</option>
                                        @foreach ($unit as $key => $value)
                                            <option value="{{ $value->id }}"
                                                {{ $value->id == old('unit_id', $product->unit_id) ? 'selected' : '' }}>
                                                {{ ucfirst($value->unit) }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="img" style="margin-bottom: 10px;">Image Upload</label>
                                    <input type="file" id="img" class="form-control" name="img"
                                        value="{{ old('address', $product->img) }}" placeholder="Enter Address">
                                    @if (!empty($product->img))
                                        <img src="{{ asset($product->img) }}" alt=""
                                            style="height: 100px; width: 100px;">
                                    @endif

                                    @if ($errors->has('address'))
                                        <p class="text-danger">{{ $errors->first('address') }}</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="purchase_price" style="margin-bottom: 10px;">Purchase</label>
                                    <input type="text" id="purchase_price" class="form-control" name="purchase_price"
                                        value="{{ old('purchase_price', $product->purchase_price) }}"
                                        placeholder="Enter purchase price" required>

                                    @if ($errors->has('purchase_price'))
                                        <p class="text-danger">{{ $errors->first('purchase_price') }}</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="sale_id" style="margin-bottom: 10px;">Sale Price</label>
                                    <input type="text" id="sale_id" class="form-control" name="sale_price"
                                        value="{{ old('sale_price', $product->sale_price) }}" placeholder="Enter "
                                        required>

                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="stock" style="margin-bottom: 10px;">Stock</label>
                                    <input type="text" id="stock" class="form-control" name="stock"
                                        value="{{ old('stock', $product->stock) }}" placeholder="Enter stock" required>

                                    @if ($errors->has('stock'))
                                        <p class="text-danger">{{ $errors->first('stock') }}</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="stock" style="margin-bottom: 10px;">Watt</label>
                                    <input type="text" id="stock" class="form-control" name="watt"
                                        value="{{ old('watt', $product->watt) }}" placeholder="Enter watt" required>
                                    @if ($errors->has('watt'))
                                        <p class="text-danger">{{ $errors->first('watt') }}</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="description" style="margin-bottom: 10px;">Description</label>
                                    <textarea name="description" id="" cols="55" rows="10" class=" d-block">{{ $product->description }}</textarea>

                                    @if ($errors->has('description'))
                                        <p class="text-danger">{{ $errors->first('description') }}</p>
                                    @endif
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">
                                        {{ $product->id != 0 ? 'Save Changes' : 'Submit' }}
                                    </button>
                                    @if ($product->id != 0)
                                        <a href="{{ route('admin.product.index') }}">
                                            <button type="button"
                                                class="btn btn-light-secondary me-1 mb-1">Cancle</button>
                                        </a>
                                    @else
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
@push('script-page-level')
@endpush
