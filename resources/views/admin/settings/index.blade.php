@extends('admin.layouts.app')
@push('style-page-level')
@endpush
@section('content')
    <section class="dashboard">
        <div class="container-fluid">
            @include('admin.common.breadcrumbs')
            <div class="row border shadow p-2" style="background-color: white; height: auto; width: 100%; margin: 0px 0px 15px;">
                <a href="{{ route('admin.settings.edit', 'null') }}"><button class="btn btn-success">Add New Setting</button></a>
                <div class="col-12 col-sm-12 col-md-12 mt-2" id="data">
                    <table id="dataTable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sr#</th>
                                <th>Name</th>
                                <th>Value</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @forelse($settings as $key => $value)
                                <tr>
                                    <td class="width-10">{{ $i }}</td>
                                    <td class="width-40">{{ $key }}</td>
                                    <td class="width-30">{{ $value }}</td>
                                    <td class="width-20">
                                        <a href="{{ route('admin.settings.edit', $key) }}" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:{};" data-url="{{ route('admin.settings.destroy',  $key) }}" title="Delete" class="delete"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @php $i++; @endphp
                            @empty
                                <tr>
                                    <td colspan="4">No Record Found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sr#</th>
                                <th>Name</th>
                                <th>Value</th>
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
