@if (Module::isEnabled('Slider') && Route::has('admin.slider.index'))
    <li class="{{ Route::is('admin.slider.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.slider.index') }}">
            <i class="fas fa-sliders-h"></i> <span>{{ __('Slider') }}</span>
        </a>
    </li>
@endif
