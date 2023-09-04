@extends('admin.layouts.app')
@push('style-page-level')
@endpush
@section('content')
    <section class="main-panel">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
                    @include('admin.common.breadcrumbs')

                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Name</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recipe as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>
                                            {{-- {{ $value->recipe }} --}}
                                            <table>
                                                @foreach ($value->recipe as $value1)
                                                    <tr>
                                                        <td>
                                                            {{ $value1->raw->name }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            {{-- {{ $value->recipe }} --}}
                                            <table>
                                                @foreach ($value->recipe as $value1)
                                                    <tr>
                                                        <td>
                                                            {{ $value1->quantity }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        {{-- <td>
                                            {{ $value->quantity }}
                                        </td> --}}

                                        <td>
                                            <a href="{{ route('admin.recipe.edit', $value->id) }}"><button
                                                    class="btn btn-primary">Add
                                                    Recipe</button></a>
                                            <a href="javascript:{};"
                                                data-url="{{ route('admin.recipe.destroy', $value->id) }}" title="Delete"
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
