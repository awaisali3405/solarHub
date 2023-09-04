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
                            <form class="form form-vertical" action="{{ $action }}" method="POST">
                                @csrf
                                <input type="hidden" value="PUT" name="_method">
                                <div class="mb-3">
                                    <label for="name" style="margin-bottom: 10px;">Name</label>
                                    <input type="text" id="name" class="form-control" name="name"
                                        value="{{ old('name', $inventory->name) }}" placeholder="Enter Name" required>

                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                                <div class="d-none">
                                    @if (empty($inventory->category->id))
                                        {{ $category_id = 0 }}
                                    @else
                                        {{ $category_id = $inventory->category->id }}
                                    @endif
                                    @if (empty($inventory->subCategory->id))
                                        {{ $sub_category_id = 0 }}
                                    @else
                                        {{ $sub_category_id = $inventory->subCategory->id }}
                                    @endif
                                    @if (empty($inventory->unit->id))
                                        {{ $unit_id = 0 }}
                                    @else
                                        {{ $unit_id = $inventory->unit->id }}
                                    @endif
                                </div>
                                <div class="d-none">

                                    <div class="mb-3">
                                        <label for="value" style="margin-bottom: 10px;"></label>
                                        <select class="form-control" name="category_id">
                                            <option value="2" selected></option>

                                        </select>
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="value" style="margin-bottom: 10px;">Sub Category</label>
                                    <select class="form-control" name="sub_category_id">
                                        <option value="">----Select Sub Category----</option>
                                        @foreach ($subCategory as $key => $value)
                                            <option value="{{ $value->id }}"
                                                {{ $value->id == old('sub_category_id', $sub_category_id) ? 'selected' : '' }}>
                                                {{ ucfirst($value->name) }}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="mb-3">
                                    <label for="value" style="margin-bottom: 10px;">Unit</label>
                                    <select class="form-control" name="unit_id">
                                        <option value="">----Select Unit----</option>
                                        @foreach ($unit as $key => $value)
                                            <option value="{{ $value->id }}"
                                                {{ $value->id == old('sub_category_id', $unit_id) ? 'selected' : '' }}>
                                                {{ ucfirst($value->unit) }}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="mb-3">
                                    <label for="purchase_price" style="margin-bottom: 10px;">Purchase</label>
                                    <input type="number" id="purchase_price" class="form-control" name="purchase_price"
                                        value="{{ old('purchase_price', $inventory->purchase_price) }}"
                                        placeholder="Enter purchase price" required>

                                    @if ($errors->has('purchase_price'))
                                        <p class="text-danger">{{ $errors->first('purchase_price') }}</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="sale_id" style="margin-bottom: 10px;">Sale Price</label>
                                    <input type="number" id="sale_id" class="form-control" name="sale_price"
                                        value="{{ old('sale_price', $inventory->sale_price) }}" placeholder="Enter "
                                        required>

                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="stock" style="margin-bottom: 10px;">Stock</label>
                                    <input type="number" id="stock" class="form-control" name="stock"
                                        value="{{ old('stock', $inventory->stock) }}" placeholder="Enter stock" required>

                                    @if ($errors->has('stock'))
                                        <p class="text-danger">{{ $errors->first('stock') }}</p>
                                    @endif
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">
                                        {{ $inventory->id != 0 ? 'Save Changes' : 'Submit' }}
                                    </button>
                                    @if ($inventory->id != 0)
                                        <a href="{{ route('admin.inventory.index') }}">
                                            <button type="button" class="btn btn-light-secondary me-1 mb-1">Cancle</button>
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
