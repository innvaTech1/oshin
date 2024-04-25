@extends('admin.master_layout')
@section('title')
    <title>{{ __('Edit Slider') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Edit Slider') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.slider.index') }}">{{ __('Slider List') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Edit Slider') }}</div>
                </div>
            </div>
            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Edit Slider') }}</h4>
                                <div>
                                    <a href="{{ route('admin.slider.index') }}" class="btn btn-primary"><i
                                            class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.slider.update',$slider->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group">
                                                <label for="title">{{ __('Title') }}</label>
                                                <input type="text" name="title" class="form-control" id="title"
                                                    value="{{ old('title', $slider->title) }}">
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group">
                                                <label for="sub_title">{{ __('Sub Title') }}</label>
                                                <input type="text" name="sub_title" class="form-control" id="sub_title"
                                                    value="{{ old('sub_title', $slider->sub_title) }}">
                                                @error('sub_title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group">
                                                <label for="button_text">{{ __('Button Text') }}</label>
                                                <input type="text" name="button_text" class="form-control"
                                                    id="button_text" value="{{ old('button_text', $slider->button_text) }}">
                                                @error('button_text')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group">
                                                <label for="button_link">{{ __('Button Link') }}</label>
                                                <input type="text" name="button_link" class="form-control"
                                                    id="button_link" value="{{ old('button_link', $slider->button_link) }}">
                                                @error('button_link')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group">
                                                <label for="order">{{ __('Slider Order') }}</label>
                                                <input type="number" name="order" class="form-control" id="order"
                                                    value="{{ old('order', $slider->order) }}">
                                                @error('order')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group">
                                                <label for="slug">{{ __('Status') }}<span
                                                        class="text-danger">*</span></label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="1"
                                                        @if ($slider->status == 1) selected @endif>
                                                        {{ __('Active') }}</option>
                                                    <option value="0"
                                                        @if ($slider->status == 0) selected @endif>
                                                        {{ __('Inactive') }}</option>
                                                </select>
                                                @error('status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        @if (Module::isEnabled('Media'))
                                            @php
                                                $image = [$slider->image ?? $slider->image];
                                            @endphp
                                            <div class="form-group col-md-8 offset-md-2">
                                                <x-media::media-input name="image" label_text="Image" :dataImages="$image"/>
                                            </div>
                                        @endif
                                        <div class="text-center offset-md-2 col-md-8">
                                            <x-admin.save-button :text="__('Save')">
                                            </x-admin.save-button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @if (Module::isEnabled('Media'))
        @stack('media_list_html')
    @endif
@endsection

@push('js')
    @if (Module::isEnabled('Media'))
        @stack('media_libary_js')
    @endif
@endpush

{{-- Media Css --}}
@push('css')
    @if (Module::isEnabled('Media'))
        @stack('media_libary_css')
    @endif
@endpush
