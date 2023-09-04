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
                                <input type="hidden" value="{{ $product->img }}" name="image">
                                <input type="hidden" value="PUT" name="_method">




                                <div class="mb-3">
                                    <label for="name" style="margin-bottom: 10px;">Name</label>
                                    <input type="text" id="name" class="form-control" name="name"
                                        value="{{ old('name', $employee->name) }}" placeholder="Enter name of employee"
                                        required>

                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="cnic" style="margin-bottom: 10px;">CNIC</label>
                                    <input type="text" id="cnic" class="form-control" name="cnic"
                                        value="{{ old('cnic', $employee->cnic) }}" placeholder="Enter Business Name"
                                        required>

                                    @if ($errors->has('business_name'))
                                        <p class="text-danger">{{ $errors->first('business_name') }}</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="phone" style="margin-bottom: 10px;">Phone Number</label>
                                    <input type="text" id="phone" class="form-control" name="phone"
                                        value="{{ old('phone', $employee->phone) }}" placeholder="Enter Phone Number"
                                        required>

                                    @if ($errors->has('phone'))
                                        <p class="text-danger">{{ $errors->first('business_name') }}</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="address" style="margin-bottom: 10px;">Contact Address</label>
                                    <input type="text" id="address" class="form-control" name="address"
                                        value="{{ old('address', $employee->address) }}" placeholder="Enter Address"
                                        required>

                                    @if ($errors->has('address'))
                                        <p class="text-danger">{{ $errors->first('address') }}</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="contract" style="margin-bottom: 10px;">Contract</label>
                                    <input type="text" id="contract" class="form-control" name="contract"
                                        value="{{ old('address', $employee->contract) }}" placeholder="Enter Address"
                                        required>

                                    @if ($errors->has('address'))
                                        <p class="text-danger">{{ $errors->first('address') }}</p>
                                    @endif
                                </div>
                                <div class="d-none">
                                    @if (empty($employee->pay_term->id))
                                        {{ $pay_term_id = 0 }}
                                    @else
                                        {{ $pay_term_id = $employee->pay_term->id }}
                                    @endif

                                </div>
                                <div class="mb-3">
                                    <label for="paying_term" style="margin-bottom: 10px;">Paying Term</label>
                                    <select class="form-control" name="paying_term">
                                        @foreach ($pay_term as $value)
                                            <option value="{{ $value->id }}"
                                                {{ $value->id == $pay_term_id ? 'selected' : '' }}>
                                                {{ $value->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('address'))
                                        <p class="text-danger">{{ $errors->first('address') }}</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="salary" style="margin-bottom: 10px;">Salary</label>
                                    <input type="number" id="salary" class="form-control" name="salary"
                                        value="{{ old('address', $employee->salary) }}" placeholder="Enter Address"
                                        required>

                                    @if ($errors->has('address'))
                                        <p class="text-danger">{{ $errors->first('address') }}</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="contract" style="margin-bottom: 10px;">Joining Date</label>
                                    <input type="date" id="contract" class="form-control" name="joining_date"
                                        value="{{ old('joining_date', $employee->joining_date != null ? $employee->joining_date->format('Y-m-d') : '') }}"
                                        placeholder="Enter Address" required>

                                    @if ($errors->has('address'))
                                        <p class="text-danger">{{ $errors->first('address') }}</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="img" style="margin-bottom: 10px;">Image Upload</label>
                                    <input type="file" id="img" class="form-control" name="img"
                                        value="{{ old('address', $employee->img) }}" placeholder="Enter Address">
                                    @if (!empty($employee))
                                        <img src="{{ asset($employee->img) }}" alt=""
                                            style="height: 100px; width: 100px;">
                                    @endif

                                    @if ($errors->has('address'))
                                        <p class="text-danger">{{ $errors->first('address') }}</p>
                                    @endif
                                </div>


                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">
                                        {{ $employee->id != 0 ? 'Save Changes' : 'Submit' }}
                                    </button>
                                    @if ($employee->id != 0)
                                        <a href="{{ route('admin.employee.index') }}">
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
