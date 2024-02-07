@extends('admin.master_layout')
@section('title')
    <title>{{ __('Crediential Setting') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.settings') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Crediential Setting') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item active"><a href="{{ route('admin.settings') }}">{{ __('Settings') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Crediential Setting') }}</div>
                </div>
            </div>
            <div class="section-body">

                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-pills flex-column" id="myTab3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link @if (request()->routeIs('admin.crediential-setting') && empty(request()->query('type'))) active show @endif"
                                            id="profile-tab3" data-toggle="tab" href="#google_recaptcha_tab" role="tab"
                                            aria-controls="profile" aria-selected="false">{{ __('Google reCaptcha') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if (request()->routeIs('admin.crediential-setting') && request()->query('type') == 'facebook_pixel') active show @endif"
                                            id="profile-tab3" data-toggle="tab" href="#facebook_pixel_tab" role="tab"
                                            aria-controls="profile" aria-selected="false">{{ __('Facebook Pixel') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if (request()->routeIs('admin.crediential-setting') && request()->query('type') == 'social_login') active show @endif"
                                            id="profile-tab3" data-toggle="tab" href="#social_login_tab" role="tab"
                                            aria-controls="profile" aria-selected="false">{{ __('Social Login') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if (request()->routeIs('admin.crediential-setting') && request()->query('type') == 'tawk_chat') active show @endif"
                                            id="profile-tab3" data-toggle="tab" href="#tawk_chat_tab" role="tab"
                                            aria-controls="profile" aria-selected="false">{{ __('Tawk Chat') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if (request()->routeIs('admin.crediential-setting') && request()->query('type') == 'google_analytic') active show @endif"
                                            id="profile-tab3" data-toggle="tab" href="#google_analytic_tab" role="tab"
                                            aria-controls="profile" aria-selected="false">{{ __('Google Analytic') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content" id="myTabContent2">
                                    <div class="tab-pane fade @if (request()->routeIs('admin.crediential-setting') && empty(request()->query('type'))) active show @endif"
                                        id="google_recaptcha_tab" role="tabpanel">
                                        <form action="{{ route('admin.update-google-captcha') }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="">{{ __('Status') }}</label>
                                                <select name="recaptcha_status" id="recaptcha_status" class="form-control">
                                                    <option {{ $setting->recaptcha_status == 'active' ? 'selected' : '' }}
                                                        value="active">{{ __('Enable') }}</option>
                                                    <option
                                                        {{ $setting->recaptcha_status == 'inactive' ? 'selected' : '' }}
                                                        value="inactive">{{ __('Disable') }}</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="">{{ __('Captcha Site Key') }}</label>
                                                @if (env('APP_MODE') == 'DEMO')
                                                    <input type="text" class="form-control" name="recaptcha_site_key"
                                                        value="ZXN39334XKF-SITE-KEY-TEST">
                                                @else
                                                    <input type="text" class="form-control" name="recaptcha_site_key"
                                                        value="{{ $setting->recaptcha_site_key }}">
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="">{{ __('Captcha Secret Key') }}</label>
                                                @if (env('APP_MODE') == 'DEMO')
                                                    <input type="text" class="form-control" name="recaptcha_secret_key"
                                                        value="ZXN39334XKF-SECRET-KEY-TEST">
                                                @else
                                                    <input type="text" class="form-control" name="recaptcha_secret_key"
                                                        value="{{ $setting->recaptcha_secret_key }}">
                                                @endif
                                            </div>

                                            <button class="btn btn-primary">{{ __('Update') }}</button>

                                        </form>
                                    </div>
                                    <div class="tab-pane fade @if (request()->routeIs('admin.crediential-setting') && request()->query('type') == 'facebook_pixel') active show @endif"
                                        id="facebook_pixel_tab" role="tabpanel">
                                        <form action="{{ route('admin.update-facebook-pixel') }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <label for="">{{ __('Status') }}</label>
                                                <select name="pixel_status" id="tawk_allow" class="form-control">
                                                    <option {{ $setting->pixel_status == 'active' ? 'selected' : '' }}
                                                        value="active">{{ __('Enable') }}</option>
                                                    <option {{ $setting->pixel_status == 'inactive' ? 'selected' : '' }}
                                                        value="inactive">{{ __('Disable') }}</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="">{{ __('Facebook App Id') }}</label>
                                                @if (env('APP_MODE') == 'DEMO')
                                                    <input type="text" value="PIXEL-APP-434334-DEMO-ID"
                                                        class="form-control" name="pixel_app_id">
                                                @else
                                                    <input type="text" value="{{ $setting->pixel_app_id }}"
                                                        class="form-control" name="pixel_app_id">
                                                @endif


                                            </div>
                                            <button class="btn btn-primary">{{ __('Update') }}</button>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade @if (request()->routeIs('admin.crediential-setting') && request()->query('type') == 'social_login') active show @endif"
                                        id="social_login_tab" role="tabpanel">
                                        <form action="{{ route('admin.update-social-login') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="">{{ __('Facebook Status') }}</label>
                                                    <select name="facebook_login_status" id="tawk_allow"
                                                        class="form-control">
                                                        <option
                                                            {{ $setting->facebook_login_status == 'active' ? 'selected' : '' }}
                                                            value="active">{{ __('Enable') }}</option>
                                                        <option
                                                            {{ $setting->facebook_login_status == 'inactive' ? 'selected' : '' }}
                                                            value="inactive">{{ __('Disable') }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="">{{ __('Facebook App Id') }}</label>
                                                @if (env('APP_MODE') == 'DEMO')
                                                    <input type="text" value="APP-DEMO-9348934-ID"
                                                        class="form-control" name="facebook_app_id">
                                                @else
                                                    <input type="text" value="{{ $setting->facebook_app_id }}"
                                                        class="form-control" name="facebook_app_id">
                                                @endif

                                            </div>

                                            <div class="form-group">
                                                <label for="">{{ __('Facebook App Secret') }}</label>
                                                @if (env('APP_MODE') == 'DEMO')
                                                    <input type="text" value="APP-ID-SECRET-39343434"
                                                        class="form-control" name="facebook_app_secret">
                                                @else
                                                    <input type="text" value="{{ $setting->facebook_app_secret }}"
                                                        class="form-control" name="facebook_app_secret">
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="">{{ __('Facebook Redirect Url') }}</label>
                                                <input type="text" value="{{ $setting->facebook_redirect_url }}"
                                                    class="form-control" name="facebook_redirect_url">
                                            </div>

                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="">{{ __('Google Status') }}</label>
                                                    <select name="google_login_status" id="tawk_allow"
                                                        class="form-control">
                                                        <option
                                                            {{ $setting->google_login_status == 'active' ? 'selected' : '' }}
                                                            value="active">{{ __('Enable') }}</option>
                                                        <option
                                                            {{ $setting->google_login_status == 'inactive' ? 'selected' : '' }}
                                                            value="inactive">{{ __('Disable') }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="">{{ __('Gmail Client Id') }}</label>
                                                @if (env('APP_MODE') == 'DEMO')
                                                    <input type="text" value="GMAIL-ID-34343-DEMO-CLIENT"
                                                        class="form-control" name="gmail_client_id">
                                                @else
                                                    <input type="text" value="{{ $setting->gmail_client_id }}"
                                                        class="form-control" name="gmail_client_id">
                                                @endif

                                            </div>

                                            <div class="form-group">
                                                <label for="">{{ __('Gmail Secret Id') }}</label>
                                                @if (env('APP_MODE') == 'DEMO')
                                                    <input type="text" value="GMAIL-ID-343943-TEST-SECRET"
                                                        class="form-control" name="gmail_secret_id">
                                                @else
                                                    <input type="text" value="{{ $setting->gmail_secret_id }}"
                                                        class="form-control" name="gmail_secret_id">
                                                @endif

                                            </div>

                                            <div class="form-group">
                                                <label for="">{{ __('Gmail Redirect Url') }}</label>
                                                <input type="text" value="{{ $setting->gmail_redirect_url }}"
                                                    class="form-control" name="gmail_redirect_url">
                                            </div>

                                            <button class="btn btn-primary">{{ __('Update') }}</button>

                                        </form>
                                    </div>
                                    <div class="tab-pane fade @if (request()->routeIs('admin.crediential-setting') && request()->query('type') == 'tawk_chat') active show @endif"
                                        id="tawk_chat_tab" role="tabpanel">
                                        <form action="{{ route('admin.update-tawk-chat') }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="">{{ __('Status') }}</label>
                                                <select name="tawk_status" id="tawk_status" class="form-control">
                                                    <option {{ $setting->tawk_status == 'active' ? 'selected' : '' }}
                                                        value="active">{{ __('Enable') }}</option>
                                                    <option {{ $setting->tawk_status == 'inactive' ? 'selected' : '' }}
                                                        value="inactive">{{ __('Disable') }}</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="">{{ __('Tawk Chat Link') }}</label>
                                                @if (env('APP_MODE') == 'DEMO')
                                                    <input type="text" class="form-control" name="tawk_chat_link"
                                                        value="https://www.tawk.to/demo-link/34893439">
                                                @else
                                                    <input type="text" class="form-control" name="tawk_chat_link"
                                                        value="{{ $setting->tawk_chat_link }}">
                                                @endif

                                            </div>

                                            <button class="btn btn-primary">{{ __('Update') }}</button>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade @if (request()->routeIs('admin.crediential-setting') && request()->query('type') == 'google_analytic') active show @endif"
                                        id="google_analytic_tab" role="tabpanel">
                                        <form action="{{ route('admin.update-google-analytic') }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="">{{ __('Status') }}</label>
                                                <select name="google_analytic_status" id="tawk_allow"
                                                    class="form-control">
                                                    <option
                                                        {{ $setting->google_analytic_status == 'active' ? 'selected' : '' }}
                                                        value="active">{{ __('Enable') }}</option>
                                                    <option
                                                        {{ $setting->google_analytic_status == 'inactive' ? 'selected' : '' }}
                                                        value="inactive">{{ __('Disable') }}</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="">{{ __('Analytic Tracking Id') }}</label>
                                                @if (env('APP_MODE') == 'DEMO')
                                                    <input type="text" class="form-control" name="google_analytic_id"
                                                        value="ANA-34343434-TEST-ID">
                                                @else
                                                    <input type="text" class="form-control" name="google_analytic_id"
                                                        value="{{ $setting->google_analytic_id }}">
                                                @endif
                                            </div>

                                            <button class="btn btn-primary">{{ __('Update') }}</button>
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
