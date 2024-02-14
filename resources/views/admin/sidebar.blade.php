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
            @if (Module::isEnabled('Blog') && checkAdminHasPermission('blog.view'))
                @include('blog::sidebar')
            @endif

            @if (Module::isEnabled('MenuBuilder') && checkAdminHasPermission('menu.view'))
                @include('menubuilder::sidebar')
            @endif

            @if (Module::isEnabled('PageBuilder') && checkAdminHasPermission('page.view'))
                @include('pagebuilder::sidebar')
            @endif

            @if (Module::isEnabled('Subscription') && checkAdminHasPermission('subscription.view'))
                @include('subscription::admin.sidebar')
            @endif

            @if (Module::isEnabled('Coupon'))
                @include('coupon::sidebar')
            @endif

            @if (Module::isEnabled('Order'))
                @include('order::sidebar')
            @endif

            @if (Module::isEnabled('Refund'))
                @include('refund::admin.sidebar')
            @endif

            @if (Module::isEnabled('Wallet'))
                @include('wallet::admin.sidebar')
            @endif

            @if (Module::isEnabled('PaymentWithdraw'))
                @include('paymentwithdraw::admin.sidebar')
            @endif

            @if (Module::isEnabled('ClubPoint'))
                @include('clubpoint::admin.sidebar')
            @endif

            @if (Module::isEnabled('GlobalSetting') && checkAdminHasPermission('setting.view'))
                <li class="{{ Route::is('admin.settings') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.settings') }}"><i class="fas fa-cog"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                </li>
            @endif

            @if (Module::isEnabled('OurTeam'))
                @include('ourteam::sidebar')
            @endif

            @if (Module::isEnabled('Customer') && checkAdminHasPermission('customer.view'))
                @include('customer::sidebar')
            @endif

            @if (Module::isEnabled('Testimonial') && checkAdminHasPermission('testimonial.view'))
                @include('testimonial::sidebar')
            @endif

            @if (Module::isEnabled('Faq') && checkAdminHasPermission('faq.view'))
                @include('faq::sidebar')
            @endif

            @if (Module::isEnabled('SupportTicket') && checkAdminHasPermission('support.ticket.view'))
                @include('supportticket::sidebar')
            @endif

            @if (Module::isEnabled('NewsLetter') && checkAdminHasPermission('newsletter.view'))
                @include('newsletter::sidebar')
            @endif

            @if (Module::isEnabled('ContactMessage') && checkAdminHasPermission('contect.message.view'))
                @include('contactmessage::sidebar')
            @endif
        </ul>

    </aside>
</div>
