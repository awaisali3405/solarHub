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
                                        value="{{ old('name', $unit->name) }}" placeholder="Enter Name" required>

                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="name" style="margin-bottom: 10px;">Unit</label>
                                    <input type="text" id="name" class="form-control" name="unit"
                                        value="{{ old('unit', $unit->unit) }}" placeholder="Enter Unit" required>

                                    @if ($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>



                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">
                                        {{ $unit->id != 0 ? 'Save Changes' : 'Submit' }}
                                    </button>
                                    @if ($unit->id != 0)
                                        <a href="{{ route('admin.unit.index') }}">
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
