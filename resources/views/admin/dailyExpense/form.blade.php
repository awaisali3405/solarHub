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
                                    <label for="amount" style="margin-bottom: 10px;">Amount</label>
                                    <input type="text" id="amount" class="form-control" name="amount"
                                        value="{{ old('amount', $dailyExpense->amount) }}"
                                        placeholder="Enter amount in Rupee" required>

                                    @if ($errors->has('amount'))
                                        <p class="text-danger">{{ $errors->first('amount') }}</p>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="value" style="margin-bottom: 10px;">Type</label>
                                    <select class="form-control" name="type">
                                        <option value="">----Select Type----</option>
                                        <option value="Payment">Payment</option>
                                        <option value="Recovery">Recovery</option>
                                    </select>


                                </div>


                                <div class="mb-3">
                                    <label for="amount" style="margin-bottom: 10px;">Date</label>
                                    <input type="date" id="amount" class="form-control" name="date" placeholder=""
                                        required>

                                    @if ($errors->has('amount'))
                                        <p class="text-danger">{{ $errors->first('amount') }}</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="description" style="margin-bottom: 10px;">Description</label>
                                    <input type="text" id="description" class="form-control" name="description"
                                        value="{{ old('description', $dailyExpense->description) }}"
                                        placeholder="Enter Description" required>

                                    @if ($errors->has('description'))
                                        <p class="text-danger">{{ $errors->first('description') }}</p>
                                    @endif
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">
                                        {{ $dailyExpense->id != 0 ? 'Save Changes' : 'Submit' }}
                                    </button>
                                    @if ($dailyExpense->id != 0)
                                        <a href="{{ route('admin.dailyExpense.index') }}">
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
