@extends('admin.layouts.app')
@push('style-page-level')
@endpush
@section('content')
    <section class="dashboard">
        <div class="container-fluid">
            @include('admin.common.breadcrumbs')
            <div class="row border shadow p-2" style="background-color: white; height: auto; width: 100%; margin: 0px 0px 15px;">
                <a href="{{ route('admin.roles.edit', 0) }}"><button class="btn btn-success">Add New Role</button></a>
                <div class="col-12 col-sm-12 col-md-12 mt-2" id="data">
                    <table id="dataTable" class="table table-striped" style="width:100%">
                        <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Name</th>
                            <th>Guard Name</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($roles as $key => $value)
                            <tr>
                                <td class="width-10">{{ $key+1 }}</td>
                                <td class="width-20">{{ $value->name }}</td>
                                <td class="width-20">{{ $value->guard_name }}</td>
                                <td class="width-15">{{ $value->created_at }}</td>
                                <td class="width-15">{{ $value->updated_at }}</td>
                                <td class="width-20">
                                    <a href="{{ route('admin.roles.edit', $value->id) }}" title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="javascript:{};" data-url="{{ route('admin.roles.destroy',  $value->id) }}" title="Delete" class="delete"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No Record Found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Sr#</th>
                            <th>Name</th>
                            <th>Guard Name</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script-page-level')
@endpush
