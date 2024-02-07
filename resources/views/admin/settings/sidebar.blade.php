<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">{{ $setting->app_name ?? '' }}</a>
        </div>

        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">{{ $setting->app_name ?? '' }}</a>
        </div>

        <ul class="sidebar-menu">
            @adminCan('dashboard.view')
                <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>
            @endadminCan

            @if (Module::isEnabled('GlobalSetting') && checkAdminHasPermission('setting.view'))
                @include('globalsetting::sidebar')
            @endif

            @if (Module::isEnabled('Language') && checkAdminHasPermission('language.view'))
                @include('language::sidebar')
            @endif

            @adminCan(['basic.payment.view', 'payment.view'])
                <li
                    class="nav-item dropdown {{ Route::is('admin.basicpayment') || Route::is('admin.paymentgateway') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i
                            class="fas fa-credit-card"></i><span>{{ __('Payment Gateway') }}</span></a>

                    <ul class="dropdown-menu">

                        @if (Module::isEnabled('BasicPayment') && checkAdminHasPermission('basic.payment.view'))
                            @include('basicpayment::sidebar')
                        @endif

                        @if (Module::isEnabled('PaymentGateway') && checkAdminHasPermission('payment.view'))
                            @include('paymentgateway::sidebar')
                        @endif

                    </ul>
                </li>
            @endadminCan

            @adminCan(['role.view', 'admin.view'])
                <li class="nav-item dropdown {{ Route::is('admin.admin.*') || Route::is('admin.role.*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i
                            class="fas fa-shield-alt"></i><span>{{ __('Admin & Roles') }}</span></a>
                    <ul class="dropdown-menu">
                        @adminCan(['admin.view'])
                            <li class="{{ Route::is('admin.admin.*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.admin.index') }}">{{ __('Manage Admin') }}</a>
                            </li>
                        @endadminCan
                        @adminCan(['role.view'])
                            <li class="{{ Route::is('admin.role.*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.role.index') }}">{{ __('Role & Permissions') }}</a>
                            </li>
                        @endadminCan
                    </ul>
                </li>
            @endadminCan
        </ul>

    </aside>
</div>
