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
                                        value="{{ old('name', $seller->name) }}" placeholder="Enter name of seller"
                                        required>

                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="business_name" style="margin-bottom: 10px;">Business Name</label>
                                    <input type="text" id="business_name" class="form-control" name="business_name"
                                        value="{{ old('business_name', $seller->business_name) }}"
                                        placeholder="Enter Business Name" required>

                                    @if ($errors->has('business_name'))
                                        <p class="text-danger">{{ $errors->first('business_name') }}</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="email" style="margin-bottom: 10px;">Email</label>
                                    <input type="email" id="email" class="form-control" name="email"
                                        value="{{ old('email', $seller->email) }}" placeholder="Enter Business Name"
                                        required>

                                    @if ($errors->has('email'))
                                        <p class="text-danger">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="cnic" style="margin-bottom: 10px;">CNIC</label>
                                    <input type="text" id="cnic" class="form-control" name="cnic"
                                        value="{{ old('cnic', $seller->cnic) }}" placeholder="Enter Business Name" required>

                                    @if ($errors->has('business_name'))
                                        <p class="text-danger">{{ $errors->first('business_name') }}</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="phone_no" style="margin-bottom: 10px;">Phone Number</label>
                                    <input type="text" id="phone" class="form-control" name="phone_no"
                                        value="{{ old('phone_no', $seller->phone_no) }}"
                                        placeholder="Enter Phone_no Number" required>

                                    @if ($errors->has('phone_no'))
                                        <p class="text-danger">{{ $errors->first('business_name') }}</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="address" style="margin-bottom: 10px;">Contact Address</label>
                                    <input type="text" id="address" class="form-control" name="address"
                                        value="{{ old('address', $seller->address) }}" placeholder="Enter Address"
                                        required>

                                    @if ($errors->has('address'))
                                        <p class="text-danger">{{ $errors->first('address') }}</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="city" style="margin-bottom: 10px;">City</label>
                                    <select name="city_id" id="" class="form-control">
                                        <option value="">Select City</option>
                                        @foreach ($city as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="address" style="margin-bottom: 10px;">Password</label>
                                    <input type="text" id="password" class="form-control" name="password" value=""
                                        placeholder="Enter Password" required>

                                    @if ($errors->has('password'))
                                        <p class="text-danger">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">
                                        {{ $seller->id != 0 ? 'Save Changes' : 'Submit' }}
                                    </button>
                                    @if ($seller->id != 0)
                                        <a href="{{ route('admin.seller.index') }}">
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
