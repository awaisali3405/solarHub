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
                                    <th>email</th>
                                    <th>Phone no.</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($user as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->phone_number }}</td>
                                        <td><img src="{{ asset($value->img) }}" alt=""
                                                style="height: 100px; width: 100px;"></td>
                                        <td>
                                            @if ($value->is_active == 1)
                                                Active
                                            @else
                                                De-Active
                                            @endif

                                        </td>

                                        <td>
                                            @if ($value->is_active == 1)
                                                <a href="{{ route('admin.user.edit', $value->id) }}" title="Deactivate"><i
                                                        style="font-size: 1.5rem" class="mdi mdi-thumb-down"></i></a>
                                            @else
                                                <a href="{{ route('admin.user.edit', $value->id) }}" title="Activate"><i
                                                        style="font-size: 1.5rem" class="mdi mdi-thumb-up"></i></a>
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
