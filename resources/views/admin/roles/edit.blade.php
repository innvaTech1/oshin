@extends('admin.master_layout')
@section('title')
    <title>{{ __('Update Role') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.role.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Update Role') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item active"><a
                            href="{{ route('admin.role.index') }}">{{ __('Manage Roles') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Update Role') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Update Role') }}</h4>
                                <div>
                                    @adminCan('role.view')
                                        <a href="{{ route('admin.role.index') }}" class="btn btn-primary"><i
                                                class="fa fa-arrow-left"></i> {{ __('Back') }}</a>
                                    @endadminCan
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form" action="{{ route('admin.role.update', $role->id) }}"
                                            method="POST">
                                            @method('PUT')
                                            @csrf
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="name">{{ __('Name') }}</label>
                                                    <input value="{{ $role->name }}" name="name" type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        id="role_name" placeholder="{{ __('Enter name') }}">
                                                    @error('name')
                                                        <span class="invalid-feedback"
                                                            role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="permission">{{ __('Permission') }}</label>
                                                    <div class="custom-control custom-checkbox">
                                                        <input
                                                            {{ App\Models\Admin::roleHasPermission($role, $permissions) ? 'checked' : '' }}
                                                            class="custom-control-input" type="checkbox" id="permission_all"
                                                            value="1">
                                                        <label for="permission_all"
                                                            class="custom-control-label">{{ __('All Permissions') }}</label>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        @php $i=1; @endphp
                                                        @foreach ($permission_groups as $group)
                                                            @php
                                                                $permissionss = App\Models\Admin::getpermissionsByGroupName($group->name);
                                                                $j = 1;
                                                            @endphp
                                                            <div class="mb-2 col-md-6 row bottom-border">
                                                                <div class="col-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input
                                                                            {{ App\Models\Admin::roleHasPermission($role, $permissions) ? 'checked' : '' }}
                                                                            class="custom-control-input permession_group"
                                                                            type="checkbox"
                                                                            id="{{ $i }}management"
                                                                            onclick="CheckPermissionByGroup('role-{{ $i }}-management-checkbox',this)"
                                                                            value="2" name="permession_group"
                                                                            data-role-id="{{ $i }}">
                                                                        <label for="{{ $i }}management"
                                                                            class="custom-control-label text-capitalize">{{ $group->name }}</label>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-9 role-{{ $i }}-management-checkbox">
                                                                    @foreach ($permissionss as $permission)
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input
                                                                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                                                                name="permissions[]"
                                                                                class="custom-control-input" type="checkbox"
                                                                                id="permission_checkbox_{{ $permission->id }}"
                                                                                value="{{ $permission->name }}"
                                                                                data-role-id="{{ $i }}">
                                                                            <label
                                                                                for="permission_checkbox_{{ $permission->id }}"
                                                                                class="custom-control-label">{{ implode(' ', array_map('ucfirst', explode('.', $permission->name))) }}</label>
                                                                        </div>
                                                                        @php $j++; @endphp
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            @php $i++; @endphp
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="text-center col-md-8 offset-md-2">
                                                    <x-admin.update-button :text="__('Update')"></x-admin.update-button>
                                                </div>
                                            </div>
                                        </form>
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
    <script>
        "use strict"
        $('input[name^="permession_group"]').on('change', function() {
            permission_all_checked();
        });

        $('#permission_all').on('click', function() {
            $('input[type=checkbox]').prop('checked', $(this).prop('checked'));
        });

        function CheckPermissionByGroup(classname, checkthis) {
            const groupIdName = $("#" + checkthis.id);
            const classCheckBox = $('.' + classname + ' input');

            classCheckBox.prop('checked', groupIdName.prop('checked'));
        }

        $('input[name^="permissions"]').on('change', function() {
            const roleId = $(this).data('role-id');
            checkGroupName(roleId)
            permission_all_checked();
        });

        function checkGroupName(roleId) {
            const groupCheckbox = $('#' + roleId + 'management');
            const groupPermissions = $('input[name^="permissions"][data-role-id="' + roleId + '"]');
            const checkedPermissionsCount = groupPermissions.filter(':checked').length;
            const totalPermissionsCount = groupPermissions.length;
            groupCheckbox.prop('checked', checkedPermissionsCount === totalPermissionsCount);
        }

        function permission_all_checked() {
            var allCheckboxesChecked = $('input[type=checkbox]').not('#permission_all').length ===
                $('input[type=checkbox]:checked').not('#permission_all').length;
            $('#permission_all').prop('checked', allCheckboxesChecked);
        }

        $('.permession_group').each(function() {
            const roleId = $(this).data('role-id');
            checkGroupName(roleId);
        });
    </script>
@endpush

@push('css')
    <style>
        .bottom-border {
            border-bottom: 1px solid rgb(56, 53, 53);
        }
    </style>
@endpush
