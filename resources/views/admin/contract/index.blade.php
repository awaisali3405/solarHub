@extends('admin.layouts.app')
@push('style-page-level')
@endpush
@section('content')
    <section class="main-panel">
        <div class="content-wrapper">
            <div class="card">
                {{-- {{ dd($employee) }} --}}
                <div class="card-body">
                    @include('admin.common.breadcrumbs')
                    <a href="{{ route('admin.contract.edit', $employee) }}"><button class="btn btn-success">Add New
                            Contract</button></a>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Product</th>
                                    <th>Cost Per Price</th>
                                    <th>Date</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($contract as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->product->name }}</td>
                                        <td>{{ $value->cost_per_product }}</td>
                                        <td>{{ $value->date->format('y-m-d') }}</td>

                                        <td>

                                            <a href="javascript:{};"
                                                data-url="{{ route('admin.contract.destroy', $value->id) }}" title="Delete"
                                                class="delete"><i class="mdi mdi-delete" style="font-size: 1.5rem"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No Record Found.</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script-page-level')
@endpush
