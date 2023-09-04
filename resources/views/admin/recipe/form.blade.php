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
                            <form class="form form-vertical" action="{{ $action }}" method="POST">
                                @csrf
                                <input type="hidden" value="PUT" name="_method">
                                <input type="hidden" value="{{ $product->id }}" name="recipe_product_id">
                                <div class="mb-3">
                                    <label for="name" style="margin-bottom: 10px;">Product Name</label>
                                    <input type="text" id="name" class="form-control" name="name"
                                        value="{{ old('name', $product->name) }}" placeholder="Enter Name" readonly>

                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                                {{-- <div class="d-none">
                                    @if (empty($raw->category->id))
                                        {{ $category_id = 0 }}
                                    @else
                                        {{ $category_id = $product->category->id }}
                                    @endif

                                </div> --}}
                                <div class="product">
                                    @forelse ($recipeDetail as $key => $valu)
                                        <div class="mb-3 d-flex product_body">
                                            <input type="hidden" id="recipe_id" value="{{ $valu->id }}">
                                            <div class="col-5 d-flex">

                                                <label for="value" style="margin-bottom: 10px;"></label>
                                                <select class="form-control" name="raw_id[]">
                                                    <option value="">----Select Raw Product----</option>
                                                    @foreach ($raw as $value)
                                                        <option value="{{ $value->id }}"
                                                            {{ $value->id == old('raw_id', $valu->raw_id) ? 'selected' : '' }}>
                                                            {{ ucfirst($value->name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-5 mx-3 ">

                                                <input type="number" id="quantity" class="form-control" name="quantity[]"
                                                    value="{{ $valu->quantity }}" placeholder="Enter Quantity">
                                            </div>
                                            <div class="col-2 ">

                                                @if ($key >= 1)
                                                    <a href="javascript:void(0);"
                                                        class="btn-sm btn-primary btn-rounded remove_product">
                                                        <i class="mdi mdi-playlist-remove"></i>
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0);" id="add_product"
                                                        class="btn-sm btn-primary btn-rounded">
                                                        <i class="mdi mdi-playlist-plus"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    @empty
                                        <div class="mb-3 d-flex">
                                            <div class="col-5 d-flex">

                                                <label for="value" style="margin-bottom: 10px;"></label>
                                                <select class="form-control" name="raw_id[]">
                                                    <option value="">----Select Raw Product----</option>
                                                    @foreach ($raw as $key => $value)
                                                        <option value="{{ $value->id }}" {{-- {{ $value->id == old('raw_id', $category_id) ? 'selected' : '' }} --}}>
                                                            {{ ucfirst($value->name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-5 mx-3 ">

                                                <input type="number" id="quantity" class="form-control" name="quantity[]"
                                                    value="" placeholder="Enter Quantity">
                                            </div>
                                            <div class="col-2 ">
                                                <a href="javascript:void(0);" id="add_product"
                                                    class="btn-sm btn-primary btn-rounded">
                                                    <i class="mdi mdi-playlist-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endforelse

                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">
                                        {{ $product->id != 0 ? 'Save Changes' : 'Submit' }}
                                    </button>
                                    @if ($product->id != 0)
                                        <a href="{{ route('admin.product.index') }}">
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
