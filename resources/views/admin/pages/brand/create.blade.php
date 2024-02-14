@extends('admin.master_layout')
@section('title')
    <title>{{ __('Create Brand') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Create Brand ') }}</h1>
            </div>

            <div class="section-body">
                <form action="{{ route('admin.brand.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="my-2">Brand Information</h4>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>{{ __('Name') }} <span class="text-danger">*</span></label>
                                            <input type="text" id="name" class="form-control" name="name"
                                                value="{{ old('name') }}">
                                        </div>
                                        <div class="form-group col-12">
                                            <label>{{ __('Slug') }} <span class="text-danger">*</span></label>
                                            <input type="text" id="slug" class="form-control" name="slug">
                                        </div>
                                        <div class="form-group col-12">
                                            <label>{{ __('Description') }}</label>
                                            <textarea id="description" class="form-control summernote" name="description" rows="3">{{ old('description') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="my-2">Other Information</h4>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>{{ __('Meta Title') }}</label>
                                            <input type="text" id="meta_title" class="form-control" name="meta_title"
                                                value="{{ old('meta_title') }}">
                                        </div>
                                        <div class="form-group col-12">
                                            <label>{{ __('Meta Description') }}</label>
                                            <textarea id="meta_description" class="form-control " name="meta_description" rows="3">{{ old('meta_description') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="my-2">Status Information</h4>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>{{ __('Logo') }} <span class="text-danger">*</span></label>
                                            <input type="file" id="logo" class="form-control" name="logo"
                                                value="{{ old('logo') }}">
                                        </div>
                                        <div class="form-group col-12">
                                            <label>{{ __('Status') }} </label>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <input type="radio" name='status' value="1" checked />
                                                    <label>{{ __('Active') }} </label>
                                                </div>
                                                <div>
                                                    <input type="radio" name='status' value="0" />
                                                    <label>{{ __('Inactive') }} </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>{{ __('featured') }} </label>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <input type="radio" name='featured' value="1" />
                                                    <label>{{ __('Is Featured') }} </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection

@push('js')
    <script>
        (function() {
            'use strict';
            $(document).ready(function() {
                $("#name").keyup(function() {
                    makeSlug("#name", '#slug');
                });
            })

        })(jQuery)
    </script>
@endpush
