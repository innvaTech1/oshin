@extends('admin.master_layout')
@section('title')
    <title>{{ __('Import Products') }}</title>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/css/dropzone.css') }}">
@endpush
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Import Products') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.product.index') }}">{{ __('Product List') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Import Products') }}</div>
                </div>
            </div>
            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>
                                    <a href="{{asset('backend/product.xlsx')}}" download>{{ __('Sample Download') }}</a>
                                </h4>
                                <div>
                                    <a href="{{ route('admin.product.index') }}" class="btn btn-primary"><i
                                            class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.product.import.store') }}" class="dropzone" id="mydropzone"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="fallback">
                                        <input name="file" type="file" accept=".csv,.xls,.xlsx" />
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="text-center offset-md-2 col-md-8">
                                        <x-admin.save-button :text="__('Save')" id="submitForm">
                                        </x-admin.save-button>
                                    </div>
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
    <script src="{{ asset('backend/js/dropzone.min.js') }}"></script>
    <script>
        Dropzone.autoDiscover = false;
        $(document).ready(function() {
            $('button').click(function() {
                $('#mydropzone').submit();
            });
        });
    </script>

@endpush
