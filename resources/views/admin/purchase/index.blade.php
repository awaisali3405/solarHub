@extends('admin.layouts.app')
@push('style-page-level')
@endpush
@section('content')
    <section class="main-panel">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
                    @include('admin.common.breadcrumbs')
                    <a href="{{ route('admin.purchase.edit', 0) }}"><button class="btn btn-success">Add New
                            Purchase</button></a>
                    <div class="table-responsive">
                        <table id="dataTable2" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Supplier</th>
                                    <th>Product</th>
                                    <th>Paid</th>
                                    <th>Remaining</th>
                                    <th>GST Tax</th>
                                    <th>WHT Tax</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($purchase as $key => $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->supplier->name }}</td>
                                        <td>
                                            <table>

                                                @foreach ($value->product as $value2)
                                                    <tr>
                                                        <td>{{ $value2->product->name }}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>{{ $value->paid }}</td>
                                        <td>{{ $value->total - $value->paid }}</td>
                                        <td>{{ $value->gst_tax }}</td>
                                        <td>{{ $value->wht_tax }}</td>
                                        <td>{{ $value->status }}</td>
                                        <td>{{ $value->total }}</td>

                                        <td>
                                            <a href="{{ route('admin.purchase.edit', $value->id) }}" title="Edit"><i
                                                    style="font-size: 1.5rem" class="mdi mdi-table-edit"></i></a>
                                            <a href="{{ route('admin.purchase.show', $value->id) }}" title="Delete"
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
