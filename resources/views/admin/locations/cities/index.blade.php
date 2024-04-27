@extends('admin.master_layout')
@section('title')
    <title>{{ __('Thana List') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Thana') }}</h1>
            </div>

            <div class="section-body">
                
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <form id="product_search_form" class="pos_pro_search_form w-100">
                                    <div class="row">
                                        <div class="col-md-5 d-flex align-items-center  mx-auto">
                                            <input type="text" class="form-control" name="search"
                                                placeholder="{{ __('Search here..') }}" autocomplete="off"
                                                value="{{ request()->get('search') }}">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- @adminCan('city.create') --}}
                <a href="{{ route('admin.city.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                    {{ __('Add New') }}</a>
                {{-- @endadminCan --}}

                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped" id="citiesTable">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SN') }}</th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('District') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($thanas as $thana)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $thana->name }}</td>
                                                    <td>{{ $thana->district->name }}</td>
                                                    <td>
                                                        {{-- @adminCan('city.edit') --}}
                                                        <a href="{{ route('admin.city.edit', $thana->id) }}"
                                                            class="btn btn-primary">{{ __('Edit') }}</a>
                                                        {{-- @endadminCan --}}
                                                        {{-- @adminCan('city.destroy') --}}
                                                        <button class="btn btn-danger" data-toggle="modal"
                                                            data-target="#deleteModal"
                                                            onclick="deleteData({{ $thana->id }})">{{ __('Delete') }}</button>
                                                        {{-- @endadminCan --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $thanas->links() }}
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
            let url = '{{ route('admin.city.destroy', ':id') }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        $('[name="search"]').on('change',function(){
            $('#product_search_form').submit();
        })
    </script>
@endpush
