@extends('admin.master_layout')
@section('title')
    <title>{{ __('All Reviews') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('All Reviews') }}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SN') }}</th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Comments') }}</th>
                                                <th>{{ __('Rating') }}</th>
                                                <th>{{ __('Product') }}</th>
                                                <th>{{ __('Comment At') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reviews as $index => $review)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>{{ html_decode($review->user->name) }}</td>
                                                    <td>{{ $review->comment }}</td>
                                                    <td>{{ $review->rating }}</td>
                                                    <td>{{ $review->product->name }}</td>
                                                    <td>{{ $review->created_at->format('h:iA, d M Y') }}</td>

                                                    <td>

                                                        <a onclick="deleteData({{ $review->id }})" href="javascript:;"
                                                            data-toggle="modal" data-target="#deleteModal"
                                                            class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('js')
    <script>
        "use strict";

        function deleteData(id) {
            let url = '{{ route('admin.reviews.delete', ':id') }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }
    </script>
@endpush
