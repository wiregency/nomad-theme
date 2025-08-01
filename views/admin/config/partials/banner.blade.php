<div class="tab-pane" id="tab-banner">
    <div class="section-header">
        <h3 class="section-title">
            <i class="bi bi-megaphone-fill me-2"></i>
            {{ trans('theme::nomad.config.admin.banner_title') }}
        </h3>
        <p class="section-description text-muted mb-0">
            {{ trans('theme::nomad.config.admin.banner_description') }}
        </p>
    </div>

    <div class="config-card">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-gear-fill me-2"></i>
                    {{ trans('theme::nomad.config.admin.banner_config_title') }}
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info mb-4">
                    <i class="bi bi-info-circle me-2"></i>
                    {{ trans('theme::nomad.config.admin.banner_info_message') }}
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input type="hidden" name="banner_enabled" value="0">
                        <input class="form-check-input @error('banner_enabled') is-invalid @enderror" 
                               type="checkbox" id="bannerEnabledCheck" name="banner_enabled" value="1" 
                               @checked(old('banner_enabled', theme_config('banner_enabled', true)))>
                        <label class="form-check-label" for="bannerEnabledCheck">
                            {{ trans('theme::nomad.config.admin.banner_enabled') }}
                        </label>
                    </div>
                    <div class="form-text">{{ trans('theme::nomad.config.admin.banner_enabled_help') }}</div>
                    @error('banner_enabled')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="bannerColorInput">{{ trans('theme::nomad.config.admin.banner_color') }}</label>
                    <input type="color" class="form-control form-control-color color-picker @error('banner_color') is-invalid @enderror" 
                           id="bannerColorInput" name="banner_color" 
                           value="{{ old('banner_color', theme_config('banner_color', '#ff3e3e')) }}">
                    @error('banner_color')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="bannerIntervalInput">{{ trans('theme::nomad.config.admin.banner_interval') }}</label>
                    <input type="number" class="form-control @error('banner_interval') is-invalid @enderror" 
                           id="bannerIntervalInput" name="banner_interval" 
                           value="{{ old('banner_interval', theme_config('banner_interval', 5)) }}" 
                           min="1" max="60" required>
                    <div class="form-text">{{ trans('theme::nomad.config.admin.banner_interval_help') }}</div>
                    @error('banner_interval')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-card-text me-2"></i>
                                {{ trans('theme::nomad.config.admin.banner_texts') }}
                            </h5>
                            <button type="button" id="addBannerButton" class="btn btn-sm btn-success">
                                <i class="bi bi-plus-lg me-1"></i> {{ trans('theme::nomad.config.admin.banner_add_text') }}
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="banner-texts">
                            @forelse(theme_config('banner_texts', [['text' => 'Bienvenue sur ' . site_name() . ' - Le serveur Minecraft ultime !']]) as $index => $banner)
                                <div class="banner-item mb-3 p-3 border rounded bg-light">
                                    <div class="row g-3">
                                        <div class="col-md-10">
                                            <label class="form-label fw-semibold">{{ trans('theme::nomad.config.admin.banner_text_placeholder') }}</label>
                                            <input type="text" class="form-control" 
                                                   name="banner_texts[{{ $index }}][text]" 
                                                   value="{{ $banner['text'] }}" 
                                                   placeholder="{{ trans('theme::nomad.config.admin.banner_text_placeholder') }}" 
                                                   required>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <button class="btn btn-outline-danger btn-sm banner-remove" type="button" title="{{ trans('theme::nomad.config.admin.banner_remove_title') }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5">
                                    <i class="bi bi-megaphone text-muted fs-1 d-block mb-3"></i>
                                    <p class="text-muted mb-0">{{ trans('theme::nomad.config.admin.banner_no_texts') }}</p>
                                </div>
                            @endforelse
                        </div>

                        <span data-lang="banner-text-placeholder" class="d-none">{{ trans('theme::nomad.config.admin.banner_text_placeholder') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 