@extends('admin.layouts.app')
@push('style-page-level')
@endpush
@section('content')
    <section class="main-panel">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
                    @include('admin.common.breadcrumbs')
                    <a href="{{ route('admin.inventory.edit', 0) }}"><button class="btn btn-success">Add New
                            Inventory</button></a>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Unit</th>
                                    <th>Purchase Price</th>
                                    <th>Sale Price</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($inventory as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->category->name }}</td>
                                        <td>{{ $value->subCategory->name }}</td>
                                        <td>{{ $value->unit->unit }}</td>
                                        <td>{{ $value->purchase_price }}</td>
                                        <td>{{ $value->sale_price }}</td>
                                        <td>{{ $value->stock }}</td>
                                        <td>{{ $value->status }}</td>

                                        <td>
                                            <a href="{{ route('admin.inventory.edit', $value->id) }}" title="Edit"><i
                                                    style="font-size: 1.5rem" class="mdi mdi-table-edit"></i></a>
                                            <a href="javascript:{};"
                                                data-url="{{ route('admin.inventory.destroy', $value->id) }}"
                                                title="Delete" class="delete"><i class="mdi mdi-delete"
                                                    style="font-size: 1.5rem"></i></a>
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
