@extends('admin.master_layout')
@section('title')
    <title>{{ __('Manage Language') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Manage Language') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Manage Language') }}</div>
                </div>
            </div>
            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Manage Language') }}</h4>
                                <div>
                                    @adminCan('language.create')
                                        <a href="{{ route('admin.languages.create') }}" class="btn btn-primary"><i
                                                class="fa fa-plus"></i>{{ __('Add New') }}</a>
                                    @endadminCan
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive max-h-400">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SN') }}</th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Code') }}</th>
                                                <th>{{ __('Direction') }}</th>
                                                <th>{{ __('Icon') }}</th>
                                                <th>{{ __('Default') }}</th>
                                                <th>{{ __('Translations') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th class="text-center">{{ __('Actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($languages as $language)
                                                <tr>
                                                    <td>
                                                        {{ $loop->index + 1 }}</td>
                                                    <td>
                                                        {{ $language->name }}
                                                    </td>
                                                    <td>
                                                        {{ $language->code }}
                                                    </td>
                                                    <td>
                                                        {{ $language->direction == 'ltr' ? __('Left to right') : __('Right to left') }}
                                                    </td>
                                                    <td>
                                                        @if ($language->icon)
                                                            <img src="{{ asset($language->icon) }}"
                                                                alt="{{ $language->name }}" width="50px">
                                                        @else
                                                            <i class="fas fa-language"></i>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="javascript:;"
                                                            onclick="changeStatus({{ $language->id }}, 'is_default')">
                                                            <input class="self-default-{{ $language->id }} default-status"
                                                                id="status_toggle" type="checkbox"
                                                                {{ $language->is_default ? 'checked' : '' }}
                                                                data-toggle="toggle" data-on="{{ __('Active') }}"
                                                                data-off="{{ __('Inactive') }}" data-onstyle="success"
                                                                data-offstyle="danger">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown d-inline">
                                                            <a class="btn btn-primary"
                                                                href="{{ route('admin.languages.edit-static-languages', $language->code) }}"
                                                                title="{{ __('Edit Language') }}">
                                                                <i class="fas fa-language"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:;"
                                                            onclick="changeStatus({{ $language->id }}, 'status')">
                                                            <input id="status_toggle" type="checkbox"
                                                                {{ $language->status ? 'checked' : '' }}
                                                                data-toggle="toggle" data-on="{{ __('Active') }}"
                                                                data-off="{{ __('Inactive') }}" data-onstyle="success"
                                                                data-offstyle="danger">
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <div>
                                                            @adminCan('language.edit')
                                                                <a href="{{ route('admin.languages.edit', $language->id) }}"
                                                                    class="m-1 text-white btn btn-sm btn-warning"
                                                                    title="Edit">
                                                                    <i class="fa fa-pen"></i>
                                                                </a>
                                                            @endadminCan
                                                            <a href="javascript:;" data-toggle="modal"
                                                                data-target="#deleteModal" class="btn btn-danger btn-sm"
                                                                onclick="deleteData({{ $language->id }})"><i
                                                                    class="fa fa-trash" aria-hidden="true"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <x-empty-table :name="__('Language')" route="admin.languages.create"
                                                    create="yes" :message="__('No data found!')" colspan="8"></x-empty-table>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $languages->links() }}
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
        function deleteData(id) {
            $("#deleteForm").attr("action", '{{ url('/admin/languages/') }}' + "/" + id)
        }

        function changeStatus(id, type) {
            var isDemo = "{{ env('PROJECT_MODE') ?? 1 }}"
            if (isDemo == 0) {
                toastr.error("{{ __('This Is Demo Version. You Can Not Change Anything') }}");
                return;
            }
            $.ajax({
                type: "put",
                data: {
                    _token: '{{ csrf_token() }}',
                    column: type
                },
                url: "{{ url('/admin/languages/update-status') }}" + "/" + id,
                success: function(response) {
                    if (response.status) {
                        toastr.success(response.message);
                        if (type == 'is_default') {
                            setTimeout(function() {
                                window.location.reload();
                            }, 2000);
                        }
                    } else {
                        toastr.warning(response.message);
                    }
                },
                error: function(err) {
                    console.log(err);

                }
            })
        }
    </script>
@endpush

@push('css')
    <style>
        .dd-custom-css {
            position: absolute;
            will-change: transform;
            top: 0px;
            left: 0px;
            transform: translate3d(0px, -131px, 0px);
        }

        .max-h-400 {
            min-height: 400px;
        }
    </style>
@endpush
