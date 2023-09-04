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


                            <div class="mb-3">
                                <label for="name" style="margin-bottom: 10px;">Name</label>
                                <input type="text" id="name" class="form-control" name="name"
                                    value="{{ old('name', $employee->name) }}" placeholder="Enter name of employee"
                                    readonly>

                                @if ($errors->has('name'))
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="cnic" style="margin-bottom: 10px;">CNIC</label>
                                <input type="text" id="cnic" class="form-control" name="cnic"
                                    value="{{ old('cnic', $employee->cnic) }}" placeholder="Enter Business Name" readonly>

                                @if ($errors->has('business_name'))
                                    <p class="text-danger">{{ $errors->first('business_name') }}</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="phone" style="margin-bottom: 10px;">Phone Number</label>
                                <input type="text" id="phone" class="form-control" name="phone"
                                    value="{{ old('phone', $employee->phone) }}" placeholder="Enter Phone Number" readonly>

                                @if ($errors->has('phone'))
                                    <p class="text-danger">{{ $errors->first('business_name') }}</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="address" style="margin-bottom: 10px;">Contact Address</label>
                                <input type="text" id="address" class="form-control" name="address"
                                    value="{{ old('address', $employee->address) }}" placeholder="Enter Address" readonly>

                                @if ($errors->has('address'))
                                    <p class="text-danger">{{ $errors->first('address') }}</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="contract" style="margin-bottom: 10px;">Contract</label>
                                <input type="text" id="contract" class="form-control" name="contract"
                                    value="{{ old('address', $employee->contract) }}" placeholder="Enter Address" readonly>

                                @if ($errors->has('address'))
                                    <p class="text-danger">{{ $errors->first('address') }}</p>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="paying_term" style="margin-bottom: 10px;">Paying Term</label>
                                <select class="form-control" name="paying_term" disabled>
                                    <option value="1">{{ $employee->pay_term->name }}</option>


                                </select>

                                @if ($errors->has('address'))
                                    <p class="text-danger">{{ $errors->first('address') }}</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="salary" style="margin-bottom: 10px;">Salary</label>
                                <input type="number" id="salary" class="form-control" name="salary"
                                    value="{{ old('address', $employee->salary) }}" placeholder="Enter Address" readonly>

                                @if ($errors->has('address'))
                                    <p class="text-danger">{{ $errors->first('address') }}</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="contract" style="margin-bottom: 10px;">Joining Date</label>
                                <input type="date" id="contract" class="form-control" name="joining_date"
                                    value="{{ old('joining_date', $employee->joining_date->format('Y-m-d')) }}"
                                    placeholder="Enter Address" readonly>

                                @if ($errors->has('address'))
                                    <p class="text-danger">{{ $errors->first('address') }}</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="img" style="margin-bottom: 10px;">Image Upload</label>

                                <br>
                                <img src="{{ asset($employee->img) }}" alt="" style="height: 100px; width: 100px;">


                                @if ($errors->has('address'))
                                    <p class="text-danger">{{ $errors->first('address') }}</p>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
@push('script-page-level')
@endpush
