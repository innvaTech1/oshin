@extends('admin.master_layout')
@section('title')
    <title>{{ __('Edit Brand') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Edit Brand ') }}</h1>
            </div>

            <div class="section-body">
                <form action="{{ route('admin.brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="my-2">{{ __('Brand Information') }}</h4>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>{{ __('Name') }} <span class="text-danger">*</span></label>
                                            <input type="text" id="name" class="form-control" name="name"
                                                value="{{ old('name', $brand->name) }}">
                                        </div>
                                        <div class="form-group col-12">
                                            <label>{{ __('Slug') }} <span class="text-danger">*</span></label>
                                            <input type="text" id="slug" class="form-control" name="slug"
                                                value="{{ old('slug', $brand->slug) }}">
                                        </div>
                                        <div class="form-group col-12">
                                            <label>{{ __('Description') }}</label>
                                            <textarea id="description" class="form-control summernote" name="description" rows="3">{{ old('description', $brand->description) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="my-2">{{ __('Other Information') }}</h4>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>{{ __('Meta Title') }}</label>
                                            <input type="text" id="meta_title" class="form-control" name="meta_title"
                                                value="{{ old('meta_title', $brand->meta_title) }}">
                                        </div>
                                        <div class="form-group col-12">
                                            <label>{{ __('Meta Description') }}</label>
                                            <textarea id="meta_description" class="form-control " name="meta_description" rows="3">{{ old('meta_description', $brand->meta_description) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="my-2">{{ __('Status Information') }}</h4>
                                    <div class="row">
                                        {{-- Media File input --}}
                                        @if (Module::isEnabled('Media'))
                                            <div class="form-group col-md-12">
                                                <x-media::media-input name="logo" multiple="no" classes="col-12 "
                                                    label_text="{{ __('Logo') }}" />
                                            </div>
                                        @endif
                                        <div class="form-group col-12">
                                            <label>{{ __('Status') }} </label>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <input type="radio" name='status' value="1" checked
                                                        @if ($brand->status == 1) checked @endif />
                                                    <label>{{ __('Active') }} </label>
                                                </div>
                                                <div>
                                                    <input type="radio" name='status' value="0"
                                                        @if ($brand->status == 0) checked @endif />
                                                    <label>{{ __('Inactive') }} </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>{{ __('featured') }} </label>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <input type="radio" name='featured' value="1"
                                                        @if ($brand->featured) checked @endif />
                                                    <label>{{ __('Is Featured') }} </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="text-center offset-md-2 col-md-8">
                                            <x-admin.save-button :text="__('Save')">
                                            </x-admin.save-button>
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

    {{-- Media Modal Show --}}
    @if (Module::isEnabled('Media'))
        @stack('media_list_html')
    @endif
@endsection

@push('js')

    {{-- Media Js --}}
    @if (Module::isEnabled('Media'))
        @stack('media_libary_js')
    @endif
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


@push('css')
    @if (Module::isEnabled('Media'))
        @stack('media_libary_css')
    @endif
@endpush
