@extends('admin.master_layout')
@section('title')
    <title>{{ __('District List') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('District') }}</h1>
            </div>

            <div class="section-body">
                {{-- @adminCan('state.create') --}}
                    <a href="{{ route('admin.state.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                        {{ __('Add New') }}</a>
                {{-- @endadminCan --}}
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SN') }}</th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($states as $index => $state)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>{{ $state->name }}</td>
                                                    <td>
                                                        {{-- @adminCan('state.edit') --}}
                                                            <a href="{{ route('admin.state.edit', $state->id) }}"
                                                                class="btn btn-primary btn-sm"><i class="fa fa-edit"
                                                                    aria-hidden="true"></i></a>
                                                        {{-- @endadminCan --}}
                                                        {{-- @adminCan('state.delete') --}}
                                                            <a href="javascript:;" data-toggle="modal"
                                                                data-target="#deleteModal" class="btn btn-danger btn-sm"
                                                                onclick="deleteData({{ $state->id }})"><i
                                                                    class="fa fa-trash" aria-hidden="true"></i></a>
                                                        {{-- @endadminCan --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="float-right">
                                    {{ $states->links() }}
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
            let url = '{{ route('admin.state.destroy', ':id') }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }
    </script>
@endpush
