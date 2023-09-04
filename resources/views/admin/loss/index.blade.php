@extends('admin.layouts.app')
@push('style-page-level')
@endpush
@section('content')
    <section class="main-panel">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
                    @include('admin.common.breadcrumbs')
                    <a href="{{ route('admin.loss.edit', 0) }}"><button class="btn btn-success">Add New
                            loss</button></a>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Category</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Description</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($loss as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->category->name }}</td>
                                        <td>{{ $value->product->name }}</td>
                                        <td>{{ $value->quantity }}</td>
                                        <td>{{ $value->description }}</td>


                                        <td>
                                            <a href="{{ route('admin.loss.edit', $value->id) }}" title="Edit"><i
                                                    style="font-size: 1.5rem" class="mdi mdi-table-edit"></i></a>
                                            <a href="javascript:{};"
                                                data-url="{{ route('admin.loss.destroy', $value->id) }}" title="Delete"
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
