@extends('admin.layouts.app')
@push('style-page-level')
@endpush
@section('content')
    <section class="main-panel">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
                    @include('admin.common.breadcrumbs')
                    <a href="{{ route('admin.accessories.edit', 0) }}"><button class="btn btn-success">Add New
                            accessories</button></a>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Name</th>
                                    <th>Watt</th>

                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($accessories as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>

                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->watt }} Watt</td>

                                        <td>
                                            <a href="{{ route('admin.accessories.edit', $value->id) }}" title="Edit"><i
                                                    style="font-size: 1.5rem" class="mdi mdi-table-edit"></i></a>
                                            @if ($value->status == 1)
                                                <a href="{{ route('admin.accessories.show', $value->id) }}" title=""
                                                    class=""><i class="mdi mdi-thumb-down"
                                                        style="font-size: 1.5rem"></i></a>
                                            @else
                                                <a href="{{ route('admin.accessories.show', $value->id) }}" title=""
                                                    class=""><i class="mdi mdi-thumb-up"
                                                        style="font-size: 1.5rem"></i></a>
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
