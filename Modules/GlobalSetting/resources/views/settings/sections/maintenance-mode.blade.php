<div class="tab-pane fade" id="mmaintenance_mode_tab" role="tabpanel">
    <div class="form-group">
        <div class="alert alert-warning alert-has-icon">
            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <div class="alert-title">{{ __('Warning') }}</div>
                {{ __('If you enable maintenance mode, regular users won\'t be able to access the website. Please make sure to inform users about the temporary unavailability.') }}
            </div>
        </div>
        <input onchange="changeMaintenanceModeStatus()" {{ $setting->maintenance_mode ? 'checked' : '' }}
            id="maintenance_mode_toggle" type="checkbox" data-toggle="toggle" data-on="{{ __('Active') }}"
            data-off="{{ __('Inactive') }}" data-onstyle="success" data-offstyle="danger">
    </div>
</div>
