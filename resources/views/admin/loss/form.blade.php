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

                                <div class="d-none">
                                    @if (empty($loss->product->id))
                                        {{ $product_id = 0 }}
                                    @else
                                        {{ $product_id = $loss->product->id }}
                                    @endif
                                    @if (empty($loss->category->id))
                                        {{ $category_id = 0 }}
                                    @else
                                        {{ $category_id = $loss->category->id }}
                                    @endif

                                </div>
                                <div class="mb-3">
                                    <label for="value" style="margin-bottom: 10px;"></label>
                                    <select class="form-control" name="category_id">
                                        <option value="">----Select Category----</option>
                                        @foreach ($category as $key => $value)
                                            <option value="{{ $value->id }}"
                                                {{ $value->id == old('category_id', $category_id) ? 'selected' : '' }}>
                                                {{ ucfirst($value->name) }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="value" style="margin-bottom: 10px;"></label>
                                    <select class="form-control" name="product_id">
                                        <option value="">----Select Product----</option>
                                        @foreach ($product as $key => $value)
                                            <option value="{{ $value->id }}"
                                                {{ $value->id == old('category_id', $product_id) ? 'selected' : '' }}>
                                                {{ ucfirst($value->name) }}</option>
                                        @endforeach
                                    </select>

                                </div>


                                <div class="mb-3">
                                    <label for="quantity" style="margin-bottom: 10px;">Quantity</label>
                                    <input type="text" id="quantity" class="form-control" name="quantity"
                                        value="{{ old('quantity', $loss->quantity) }}" placeholder="Enter Quantity In Kg"
                                        required>

                                    @if ($errors->has('quantity'))
                                        <p class="text-danger">{{ $errors->first('quantity') }}</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="description" style="margin-bottom: 10px;">Description</label>
                                    <input type="text" id="description" class="form-control" name="description"
                                        value="{{ old('description', $loss->description) }}"
                                        placeholder="Enter Description" required>

                                    @if ($errors->has('description'))
                                        <p class="text-danger">{{ $errors->first('description') }}</p>
                                    @endif
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">
                                        {{ $loss->id != 0 ? 'Save Changes' : 'Submit' }}
                                    </button>
                                    @if ($loss->id != 0)
                                        <a href="{{ route('admin.loss.index') }}">
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
