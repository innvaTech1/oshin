@extends('admin.master_layout')

@section('title')
    <title>{{ __('Brand List') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Brand List') }}</h1>
            </div>

            <div class="section-body">

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('admin.brand.create') }}"
                                    class="btn btn-primary">{{ __('Add New Brand') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SN') }}</th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Logo') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Featured') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($brands as $index => $brand)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>{{ $brand->name }}</td>
                                                    <td><img src="{{ asset($brand->logo) }}" alt=""></td>
                                                    <td>{{ $brand->status }}</td>
                                                    <td>{{ $brand->featured }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.brand.edit', $brand->id) }}"
                                                            class="btn btn-primary btn-sm edit-btn"><i class="fa fa-edit"
                                                                aria-hidden="true"></i></a>
                                                        <a href="javascript:;" data-toggle="modal"
                                                            data-target="#deleteModal" class="btn btn-danger btn-sm"
                                                            onclick="deleteData({{ $brand->id }})"><i
                                                                class="fa fa-trash" aria-hidden="true"></i></a>
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
        </section>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $("#name").keyup(function() {
                makeSlug("#name", '#slug');
            });
        });

        function deleteData(id) {
            let url = '{{ route('admin.brand.destroy', ':id') }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }
    </script>
@endpush
