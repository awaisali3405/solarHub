@extends('admin.layouts.app')
@push('style-page-level')
@endpush
@section('content')
    <section class="main-panel">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
                    @include('admin.common.breadcrumbs')
                    <a href="{{ route('admin.employee.edit', 0) }}"><button class="btn btn-success">Add New
                            employee</button></a>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Name</th>
                                    <th>CNIC</th>
                                    <th>Phone no.</th>
                                    <th>Contact Address</th>
                                    <th>Image</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($employee as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->cnic }}</td>
                                        <td>{{ $value->phone }}</td>
                                        <td>{{ $value->address }}</td>
                                        <td><img src="{{ asset($value->img) }}" alt=""
                                                style="height: 100px; width: 100px;"></td>

                                        <td>
                                            <div class="col-3">

                                                <a href="{{ route('admin.employee.show', $value->id) }}" title="Show"><i
                                                        style="font-size: 1.5rem" class="mdi mdi-eye"></i></a>
                                                <a href="{{ route('admin.employee.edit', $value->id) }}" title="Edit"><i
                                                        style="font-size: 1.5rem" class="mdi mdi-table-edit"></i></a>
                                                <a href="javascript:{};"
                                                    data-url="{{ route('admin.employee.destroy', $value->id) }}"
                                                    title="Delete" class="delete"><i class="mdi mdi-delete"
                                                        style="font-size: 1.5rem"></i></a>
                                            </div>
                                            <div class="col-3">
                                                @if ($value->paying_term == 2)
                                                    <a href="{{ route('admin.contract.show', $value->id) }}"
                                                        class="btn btn-success">Contract</a>
                                                    <a href="{{ route('admin.work.show', $value->id) }}"
                                                        class="btn btn-success">Work</a>
                                                @else
                                                    <a href="{{ route('admin.employee.salary', $value->id) }}"
                                                        class="btn btn-success">Salary</a>
                                                @endif
                                            </div>
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
