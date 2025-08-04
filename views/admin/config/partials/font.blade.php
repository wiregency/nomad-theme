<div class="tab-pane" id="tab-font">
    <div class="section-header">
        <h3 class="section-title">{{ trans('theme::nomad.config.admin.font.title') }}</h3>
        <p class="section-description">{{ trans('theme::nomad.config.admin.font.description') }}</p>
    </div>

    <div class="config-card">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-type me-2"></i>
                    {{ trans('theme::nomad.config.admin.font.custom_font') }}
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="font_enabled" name="font_enabled" value="1" {{ theme_config('font_enabled') ? 'checked' : '' }}>
                            <label class="form-check-label" for="font_enabled">
                                {{ trans('theme::nomad.config.admin.font.enable_custom_font') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row" id="font-settings" style="{{ theme_config('font_enabled') ? '' : 'display: none;' }}">
                    <div class="col-md-6 mb-3">
                        <label for="font_url" class="form-label">
                            <i class="bi bi-link-45deg me-2"></i>
                            {{ trans('theme::nomad.config.admin.font.url_label') }}
                        </label>
                        <input type="url" class="form-control" id="font_url" name="font_url" 
                               value="{{ theme_config('font_url') }}" 
                               placeholder="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
                        <div class="form-text">
                            {{ trans('theme::nomad.config.admin.font.url_help') }}
                            <a href="https://fonts.google.com/" target="_blank" rel="noopener noreferrer">
                                {{ trans('theme::nomad.config.admin.font.google_fonts') }}
                            </a>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="font_family" class="form-label">
                            <i class="bi bi-type me-2"></i>
                            {{ trans('theme::nomad.config.admin.font.family_label') }}
                        </label>
                        <input type="text" class="form-control" id="font_family" name="font_family" 
                               value="{{ theme_config('font_family') }}" 
                               placeholder="Roboto, sans-serif">
                        <div class="form-text">
                            {{ trans('theme::nomad.config.admin.font.family_help') }}
                        </div>
                    </div>
                </div>

                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>{{ trans('theme::nomad.config.admin.font.tips_title') }}</strong>
                    <ul class="mb-0 mt-2">
                        <li>{{ trans('theme::nomad.config.admin.font.tip_1') }}</li>
                        <li>{{ trans('theme::nomad.config.admin.font.tip_2') }}</li>
                        <li>{{ trans('theme::nomad.config.admin.font.tip_3') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> 