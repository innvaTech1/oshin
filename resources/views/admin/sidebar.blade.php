<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}"><img class="w-75" src=""
                    alt="{{ $setting->app_name ?? '' }}"></a>
        </div>

        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}"><img src="" alt="{{ $setting->app_name ?? '' }}"></a>
        </div>

        <ul class="sidebar-menu">
            @adminCan('dashboard.view')
                <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>
            @endadminCan

            @if (Module::isEnabled('Product'))
                @include('product::sidebar')
            @endif

            <li class="{{ Route::is('admin.shipping.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.shipping.index') }}"><i class="fas fa-shipping-fast"></i>
                    <span>{{ __('Shipping') }}</span>
                </a>
            </li>

            <li class="nav-item dropdown {{ Route::is('admin.state.*') | Route::is('admin.city.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i
                        class="fas fa-map-marker-alt"></i><span>{{ __('Location') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('admin.state.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.state.index') }}">{{ __('District') }}</a>
                    </li>
                    <li class="{{ Route::is('admin.city.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.city.index') }}">{{ __('Thana') }}</a>
                    </li>
                </ul>
            </li>


            <li class="menu-header">{{ __('Manage Contents') }}</li>

            @if (Module::isEnabled('Media') && checkAdminHasPermission('media.view'))
                @include('media::sidebar')
            @endif

            @if (Module::isEnabled('Customer') && checkAdminHasPermission('customer.view'))
                @include('customer::sidebar')
            @endif


            <li class="menu-header">{{ __('Manage Website') }}</li>

            @if (Module::isEnabled('Slider'))
                @include('slider::sidebar')
            @endif
            @if (Module::isEnabled('Faq') && checkAdminHasPermission('faq.view'))
                @include('faq::sidebar')
            @endif

            <li class="menu-header">{{ __('Manage Orders') }}</li>

            @if (Module::isEnabled('Coupon'))
                @include('coupon::sidebar')
            @endif

            @if (Module::isEnabled('Order'))
                @include('order::sidebar')
            @endif

            @if (Module::isEnabled('Refund'))
                @include('refund::admin.sidebar')
            @endif
            {{-- @adminCan('reviews.list') --}}
            <li class="{{ Route::is('admin.reviews') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.reviews') }}"><i class="fas fa-comment-dots"></i>
                    <span>{{ __('Reviews') }}</span>
                </a>
            </li>
            {{-- @endadminCan --}}

            {{-- @if (Module::isEnabled('PaymentWithdraw'))
                @include('paymentwithdraw::admin.sidebar')
            @endif --}}

            <li class="menu-header">{{ __('Settings') }}</li>

            @if (Module::isEnabled('GlobalSetting') && checkAdminHasPermission('setting.view'))
                <li class="{{ Route::is('admin.settings') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.settings') }}"><i class="fas fa-cog"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                </li>
            @endif

            {{-- @if (Module::isEnabled('Wallet'))
                @include('wallet::admin.sidebar')
            @endif --}}

            {{-- <li class="menu-header">{{ __('Utility') }}</li>

            @if (Module::isEnabled('ContactMessage') && checkAdminHasPermission('contect.message.view'))
                @include('contactmessage::sidebar')
            @endif --}}
        </ul>

        <div class="py-3 text-center">
            <div class="btn-group">
                <button class="btn btn-danger"
                    onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">Logout <i
                        class="fas fa-sign-out-alt"></i></button>
            </div>
        </div>

    </aside>
</div>
