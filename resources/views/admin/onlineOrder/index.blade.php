@extends('admin.layouts.app')
@push('style-page-level')
@endpush
@section('content')
    <section class="main-panel">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
                    @include('admin.common.breadcrumbs')
                    <a href="{{ route('admin.onlineOrder.show', 1) }}"><button class="btn btn-success">
                            Pending({{ $pending }})</button></a>
                    <a href="{{ route('admin.onlineOrder.show', 2) }}"><button class="btn btn-success">In
                            Process({{ $inProcess }})</button></a>
                    <a href="{{ route('admin.onlineOrder.show', 5) }}"><button
                            class="btn btn-success">Completed({{ $completed }})</button></a>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Order ID#</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Customer Name</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    {{-- <th>Action</th> --}}

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($order as $key => $value)
                                    <tr>
                                        <td>{{ $value->order_id }}</td>
                                        <td>{{ $value->product->name }}</td>
                                        <td>{{ $value->quantity }}</td>
                                        <td>{{ $value->customer->name }}</td>
                                        <td>
                                            @if ($value->need_stock != 0)
                                                You need {{ $value->need_stock }} product to complete this order
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.onlineOrder.status.update', $value->id) }}"
                                                method="post" class="d-flex">
                                                @csrf
                                                <select class="form-control" name="status_id" id="status">
                                                    @foreach ($status as $key => $value1)
                                                        <option value="{{ $value1->id }}"
                                                            {{ $value1->id == old('status_id', $value->status_id) ? 'selected' : '' }}>
                                                            {{ ucfirst($value1->name) }}</option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-link"><i style="font-size: 1.5rem"
                                                        class="mdi mdi-table-edit"></i></button>
                                            </form>
                                        </td>

                                        {{-- <td>
                                            <a href="{{ route('admin.onlineOrder.edit', $value->id) }}" title="Edit"><i
                                                    style="font-size: 1.5rem" class="mdi mdi-table-edit"></i></a>

                                        </td> --}}
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
