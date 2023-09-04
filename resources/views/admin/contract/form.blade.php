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
                                <input type="hidden" value="{{ $employee }}" name="employee_id">
                                <div class="mb-3">
                                    <label for="name" style="margin-bottom: 10px;">Name</label>
                                    <input type="text" id="name" class="form-control" name="name" value=""
                                        placeholder="Enter Name" required>

                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>


                                <div class="mb-3">
                                    <label for="value" style="margin-bottom: 10px;"> Product</label>
                                    <select class="form-control" name="product_id">
                                        <option value="">----Select product----</option>
                                        @foreach ($product as $key => $value)
                                            <option value="{{ $value->id }}">
                                                {{ ucfirst($value->name) }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="name" style="margin-bottom: 10px;">Cost Per Price</label>
                                    <input type="text" id="name" class="form-control" name="cost_per_product"
                                        value="" placeholder="Enter Cost Per Product" required>

                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="name" style="margin-bottom: 10px;">Date</label>
                                    <input type="date" id="name" class="form-control" name="date" value=""
                                        placeholder="Enter Name" required>

                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">
                                        Submit
                                    </button>

                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>

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
