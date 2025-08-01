<div class="tab-pane" id="tab-cta">
    <div class="section-header">
        <h3 class="section-title">
            <i class="bi bi-cursor-fill me-2"></i>
            {{ trans('theme::nomad.config.admin.cta_title_section') }}
        </h3>
        <p class="section-description text-muted mb-0">
            {{ trans('theme::nomad.config.admin.cta_description_section') }}
        </p>
    </div>

    <div class="config-card">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-megaphone me-2"></i>
                    {{ trans('theme::nomad.config.admin.cta_content_title') }}
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label" for="ctaTitleInput">{{ trans('theme::nomad.config.cta_title') }}</label>
                    <input type="text" class="form-control @error('cta_title') is-invalid @enderror" 
                           id="ctaTitleInput" name="cta_title" 
                           value="{{ old('cta_title', theme_config('cta_title')) }}"
                           placeholder="{{ trans('theme::nomad.config.cta_title_placeholder') }}">

                    @error('cta_title')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="ctaDescriptionInput">{{ trans('theme::nomad.config.cta_description') }}</label>
                    <textarea class="form-control @error('cta_description') is-invalid @enderror" 
                              id="ctaDescriptionInput" name="cta_description" rows="3"
                              placeholder="{{ trans('theme::nomad.config.cta_description_placeholder') }}">{{ old('cta_description', theme_config('cta_description')) }}</textarea>

                    @error('cta_description')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="config-card">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-mouse me-2"></i>
                    {{ trans('theme::nomad.config.admin.cta_button_title') }}
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">{{ trans('theme::nomad.config.cta_button_type') }}</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cta_button_type" id="buttonTypeServer" 
                               value="server" @checked(old('cta_button_type', theme_config('cta_button_type', 'server')) === 'server')>
                        <label class="form-check-label" for="buttonTypeServer">
                            <strong>{{ trans('theme::nomad.config.cta_button_type_server') }}</strong>
                            <small class="d-block text-muted">{{ trans('theme::nomad.config.admin.cta_button_server_help') }}</small>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cta_button_type" id="buttonTypeCustom" 
                               value="custom" @checked(old('cta_button_type', theme_config('cta_button_type')) === 'custom')>
                        <label class="form-check-label" for="buttonTypeCustom">
                            <strong>{{ trans('theme::nomad.config.cta_button_type_custom') }}</strong>
                            <small class="d-block text-muted">{{ trans('theme::nomad.config.admin.cta_button_custom_help') }}</small>
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="ctaButtonTextInput">{{ trans('theme::nomad.config.cta_button_text') }}</label>
                    <input type="text" class="form-control @error('cta_button_text') is-invalid @enderror" 
                           id="ctaButtonTextInput" name="cta_button_text" 
                           value="{{ old('cta_button_text', theme_config('cta_button_text')) }}"
                           placeholder="{{ trans('theme::nomad.config.cta_button_text_placeholder') }}">

                    @error('cta_button_text')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div id="customButtonFields">
                    <div class="mb-3">
                        <label class="form-label" for="ctaButtonLinkInput">{{ trans('theme::nomad.config.cta_button_link') }}</label>
                        <input type="url" class="form-control @error('cta_button_link') is-invalid @enderror" 
                               id="ctaButtonLinkInput" name="cta_button_link" 
                               value="{{ old('cta_button_link', theme_config('cta_button_link')) }}"
                               placeholder="{{ trans('theme::nomad.config.cta_button_link_placeholder') }}">

                        @error('cta_button_link')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>