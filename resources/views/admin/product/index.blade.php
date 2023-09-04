@extends('admin.layouts.app')
@push('style-page-level')
@endpush
@section('content')
    <section class="main-panel">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
                    @include('admin.common.breadcrumbs')
                    <a href="{{ route('admin.product.edit', 0) }}"><button class="btn btn-success">Add New
                            Product</button></a>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Unit</th>
                                    <th>Purchase Price</th>
                                    <th>Sale Price</th>
                                    <th>Stock</th>
                                    <th>Watt</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($product as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><img src="{{ asset($value->img) }}" alt=""
                                                style="height: 100px; width: 100px;"></td>


                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->category->name }}</td>
                                        <td>{{ $value->subCategory->name }}</td>
                                        <td>{{ $value->unit->unit }}</td>
                                        <td>{{ $value->purchase_price }}</td>
                                        <td>{{ $value->sale_price }}</td>
                                        <td>{{ $value->stock }}</td>
                                        <td>{{ $value->watt }} watt</td>
                                        <td>
                                            @if ($value->status == 1)
                                                Active
                                            @else
                                                De-Active
                                            @endif

                                        </td>

                                        <td>
                                            <a href="{{ route('admin.product.edit', $value->id) }}" title="Edit"><i
                                                    style="font-size: 1.5rem" class="mdi mdi-table-edit"></i></a>
                                            @if ($value->status == 1)
                                                <a href="{{ route('admin.product.show', $value->id) }}" title=""
                                                    class=""><i class="mdi mdi-thumb-down"
                                                        style="font-size: 1.5rem"></i></a>
                                            @else
                                                <a href="{{ route('admin.product.show', $value->id) }}" title=""
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
