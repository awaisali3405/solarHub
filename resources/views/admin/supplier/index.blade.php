@extends('admin.layouts.app')
@push('style-page-level')
@endpush
@section('content')
    <section class="main-panel">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
                    @include('admin.common.breadcrumbs')
                    <a href="{{ route('admin.supplier.edit', 0) }}"><button class="btn btn-success">Add New
                            supplier</button></a>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Name</th>
                                    <th>Business Name</th>
                                    <th>CNIC</th>
                                    <th>Phone no.</th>
                                    <th>Contact Address</th>

                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($supplier as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->business_name }}</td>
                                        <td>{{ $value->cnic }}</td>
                                        <td>{{ $value->phone }}</td>
                                        <td>{{ $value->address }}</td>
                                        <td>
                                            @if ($value->status == 1)
                                                Active
                                            @else
                                                De-Active
                                            @endif

                                        </td>

                                        <td>
                                            <a href="{{ route('admin.supplier.edit', $value->id) }}" title="Edit"><i
                                                    style="font-size: 1.5rem" class="mdi mdi-table-edit"></i></a>
                                            @if ($value->status == 1)
                                                <a href="{{ route('admin.supplier.show', $value->id) }}"
                                                    title="Deactivate"><i style="font-size: 1.5rem"
                                                        class="mdi mdi-thumb-down"></i></a>
                                            @else
                                                <a href="{{ route('admin.supplier.show', $value->id) }}" title="Activate"><i
                                                        style="font-size: 1.5rem" class="mdi mdi-thumb-up"></i></a>
                                            @endif
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
