@extends('admin.master_layout')
@section('title')
    <title>{{ __('Settings') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Settings') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Settings') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    @if (Module::isEnabled('GlobalSetting') && checkAdminHasPermission('setting.view'))
                        <div class="col-lg-6">
                            <div class="card card-large-icons">
                                <div class="card-icon bg-primary text-white">
                                    <i class="fas fa-cog"></i>
                                </div>
                                <div class="card-body">
                                    <h4>{{ __('General Setting') }}</h4>
                                    <a href="{{ route('admin.general-setting') }}"
                                        class="card-cta">{{ __('Change Setting') }}
                                        <i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card card-large-icons">
                                <div class="card-icon bg-primary text-white">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="card-body">
                                    <h4>{{ __('Email Configuration') }}</h4>
                                    <a href="{{ route('admin.email-configuration') }}"
                                        class="card-cta">{{ __('Change Setting') }} <i
                                            class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card card-large-icons">
                                <div class="card-icon bg-primary text-white">
                                    <i class="fas fa-key"></i>
                                </div>
                                <div class="card-body">
                                    <h4>{{ __('Crediential Setting') }}</h4>
                                    <a href="{{ route('admin.crediential-setting') }}"
                                        class="card-cta">{{ __('Change Setting') }} <i
                                            class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card card-large-icons">
                                <div class="card-icon bg-primary text-white">
                                    <i class="fas fa-language"></i>
                                </div>
                                <div class="card-body">
                                    <h4>{{ __('Manage Language') }}</h4>
                                    <a href="{{ route('admin.languages.index') }}"
                                        class="card-cta">{{ __('Change Setting') }} <i
                                            class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card card-large-icons">
                                <div class="card-icon bg-primary text-white">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <div class="card-body">
                                    <h4>{{ __('Payment Gateway') }}</h4>
                                    <a href="{{ route('admin.basicpayment') }}"
                                        class="card-cta">{{ __('Change Setting') }} <i
                                            class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endif
                    @adminCan(['role.view', 'admin.view'])
                        <div class="col-lg-6">
                            <div class="card card-large-icons">
                                <div class="card-icon bg-primary text-white">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div class="card-body">
                                    <h4>{{ __('Admin & Roles') }}</h4>
                                    <a href="{{ route('admin.admin.index') }}" class="card-cta">{{ __('Change Setting') }} <i
                                            class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endadminCan
                </div>
            </div>
        </section>
    </div>
@endsection
