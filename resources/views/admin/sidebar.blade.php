<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}"><img class="w-75" src="{{ asset($setting->logo) ?? '' }}"
                    alt="{{ $setting->app_name ?? '' }}"></a>
        </div>

        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}"><img src="{{ asset($setting->favicon) ?? '' }}"
                    alt="{{ $setting->app_name ?? '' }}"></a>
        </div>

        <ul class="sidebar-menu">
            @adminCan('dashboard.view')
                <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>
            @endadminCan
            <li class="menu-header">{{ __('Manage Product') }}</li>

            <li class="nav-item dropdown {{ Route::is('admin.products.*') ? 'active' : '' }}">
                <a href="javascript:void()" class="nav-link has-dropdown"><i
                        class="fas fa-newspaper"></i><span>{{ __('Manage Products') }}</span></a>

                <ul class="dropdown-menu">
                    <li class="{{ Route::is('admin.category*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.category.index') }}">
                            {{ __('Category') }}
                        </a>
                    </li>
                    <li class="{{ Route::is('admin.brand*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.brand.index') }}">
                            {{ __('Brand') }}
                        </a>
                    </li>
                    <li class="{{ Route::is('admin.attribute*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.attribute.index') }}">
                            {{ __('Attribute') }}
                        </a>
                    </li>
                    <li class="{{ Route::is('admin.unit*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.unit.index') }}">
                            {{ __('Unit Type') }}
                        </a>
                    </li>
                    <li class="{{ Route::is('admin.product.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.product.index') }}">
                            {{ __('Product List') }}
                        </a>
                    </li>
                    <li class="{{ Route::is('admin.product.create') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.product.create') }}">
                            {{ __('Add Product') }}
                        </a>
                    </li>
                    <li class="{{ Route::is('admin.blogs.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.blogs.index') }}">
                            {{ __('Post List') }}
                        </a>
                    </li>
                    <li class="{{ Route::is('admin.blog-comment.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.blog-comment.index') }}">
                            {{ __('Post Comments') }}
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-header">{{ __('Manage Contents') }}</li>

            @if (Module::isEnabled('Blog') && checkAdminHasPermission('blog.view'))
                @include('blog::sidebar')
            @endif

            @if (Module::isEnabled('Media') && checkAdminHasPermission('media.view'))
                @include('media::sidebar')
            @endif

            @if (Module::isEnabled('Customer') && checkAdminHasPermission('customer.view'))
                @include('customer::sidebar')
            @endif


            <li class="menu-header">{{ __('Manage Website') }}</li>

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

            @if (Module::isEnabled('PaymentWithdraw'))
                @include('paymentwithdraw::admin.sidebar')
            @endif

            <li class="menu-header">{{ __('Settings') }}</li>

            @if (Module::isEnabled('GlobalSetting') && checkAdminHasPermission('setting.view'))
                <li class="{{ Route::is('admin.settings') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.settings') }}"><i class="fas fa-cog"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                </li>
            @endif

            @if (Module::isEnabled('Wallet'))
                @include('wallet::admin.sidebar')
            @endif

            @if (Module::isEnabled('ClubPoint'))
                @include('clubpoint::admin.sidebar')
            @endif

            <li class="menu-header">{{ __('Utility') }}</li>

            @if (Module::isEnabled('SupportTicket') && checkAdminHasPermission('support.ticket.view'))
                @include('supportticket::sidebar')
            @endif

            @if (Module::isEnabled('NewsLetter') && checkAdminHasPermission('newsletter.view'))
                @include('newsletter::sidebar')
            @endif

            @if (Module::isEnabled('Testimonial') && checkAdminHasPermission('testimonial.view'))
                @include('testimonial::sidebar')
            @endif

            @if (Module::isEnabled('ContactMessage') && checkAdminHasPermission('contect.message.view'))
                @include('contactmessage::sidebar')
            @endif
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
