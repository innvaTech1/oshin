@extends('admin.master_layout')
@section('title')
    <title>{{ __('Slider List') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Slider') }}</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>
                                    <a href="{{ route('admin.slider.create') }}" class="btn btn-primary"><i
                                            class="fa fa-plus"></i>
                                        {{ __('Add Slider') }}</a>
                                </h4>
                            </div>
                            <div class="card-body text-center">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SL.') }}</th>
                                                <th>{{ __('Title') }}</th>
                                                <th>{{ __('Sub Title') }}</th>
                                                <th>{{ __('Image') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($sliders as $slider)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $slider->title }}</td>
                                                    <td>{{ $slider->sub_title }}</td>
                                                    <td> <img class="rounded-circle" src="{{ asset($slider->image_url) }}"
                                                            alt="" width="100px" height="100px"></td>
                                                    <td>
                                                        <a href="{{ route('admin.slider.edit', $slider->id) }}"
                                                            class="btn btn-primary btn-action mr-1" data-toggle="tooltip"
                                                            title="{{ __('Edit') }}"><i
                                                                class="fas fa-pencil-alt"></i></a>
                                                        <a href="javascript:void(0)"
                                                            class="btn btn-danger btn-action trigger--fire-modal-1 deleteForm"
                                                            data-toggle="modal" data-target="#deleteModal"
                                                            data-toggle="tooltip" title="{{ __('Delete') }}"
                                                            data-url="{{ route('admin.slider.destroy', $slider->id) }}"
                                                            data-form="deleteForm"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <x-empty-table :name="__('slider')" route="admin.slider.create"
                                                    create="yes" :message="__('No data found!')" colspan="5"></x-empty-table>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $categories->links() }}
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
        $(document).ready(function() {
            'use strict';
            $('.deleteForm').on('click', function() {
                var url = $(this).data('url');
                $('#deleteForm').attr('action', url);
            });
        });
    </script>
@endpush