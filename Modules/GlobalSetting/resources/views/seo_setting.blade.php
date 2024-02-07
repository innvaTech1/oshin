@extends('admin.master_layout')
@section('title')
    <title>{{ __('SEO Setup') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('SEO Setup') }}</h1>
            </div>
            <div class="section-body">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-3">
                                    <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                                        @foreach ($pages as $index => $page)
                                            <li class="nav-item border rounded mb-1">
                                                <a class="nav-link {{ $index == 0 ? 'active' : '' }}"
                                                    id="error-tab-{{ $page->id }}" data-toggle="tab"
                                                    href="#errorTab-{{ $page->id }}" role="tab"
                                                    aria-controls="errorTab-{{ $page->id }}"
                                                    aria-selected="true">{{ $page->page_name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-12 col-sm-12 col-md-9">
                                    <div class="border rounded">
                                        <div class="tab-content no-padding" id="settingsContent">
                                            @foreach ($pages as $index => $page)
                                                <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}"
                                                    id="errorTab-{{ $page->id }}" role="tabpanel"
                                                    aria-labelledby="error-tab-{{ $page->id }}">
                                                    <div class="card m-0">
                                                        <div class="card-body">
                                                            <form
                                                                action="{{ route('admin.update-seo-setting', $page->id) }}"
                                                                method="POST">
                                                                @method('PUT')
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="">{{ __('Seo Title') }}</label>
                                                                            <input type="text" name="seo_title"
                                                                                class="form-control"
                                                                                value="{{ $page->seo_title }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="">{{ __('SEO Description') }}</label>
                                                                            <textarea name="seo_description" id="" cols="30" rows="5" class="form-control text-area-5">{{ $page->seo_description }}</textarea>

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <button type="submit"
                                                                    class="btn btn-primary">{{ __('Update') }}</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
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
