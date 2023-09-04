@extends('admin.layouts.app')
@push('style-page-level')
@endpush
@section('content')
    <section class="dashboard">
        <div class="container-fluid">
            @include('admin.common.breadcrumbs')
            <div class="row border shadow p-2" style="background-color: white; height: auto; width: 100%; margin: 0px 0px 15px;">
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
                                <input type="hidden" value="{{ $setting->key }}" name="old">
                                <div class="mb-3">
                                    <label for="name" style="margin-bottom: 10px;">Name</label>
                                    <input type="text" id="name"
                                           class="form-control" name="key"
                                           value="{{ old('key', $setting->key) }}"
                                           placeholder="Enter Name" required {{ $setting->key != '' ? 'readonly' : '' }}>

                                    @if($errors->has('key'))
                                        <p class="text-danger">{{ $errors->first('key') }}</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="value" style="margin-bottom: 10px;">Value</label>
                                    <input type="text" id="value"
                                           class="form-control" name="value"
                                           value="{{ old('value', $setting->value) }}"
                                           placeholder="Enter Value" required>
                                </div>
                                @if($errors->has('value'))
                                    <p class="text-danger">{{ $errors->first('value') }}</p>
                                @endif

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">
                                        {{ $setting->key != '' ? 'Save Changes' : 'Submit' }}
                                    </button>
                                    @if($setting->key != '')
                                        <a href="{{ route('admin.settings.index') }}">
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
