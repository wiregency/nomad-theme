<div class="tab-pane" id="tab-general">
    <div class="section-header">
        <h3 class="section-title">
            <i class="bi bi-gear-fill me-2"></i>
            {{ trans('theme::nomad.config.admin.general_title') }}
        </h3>
        <p class="section-description text-muted mb-0">
            {{ trans('theme::nomad.config.admin.general_description') }}
        </p>
    </div>

    <div class="config-card">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-palette me-2"></i>
                    {{ trans('theme::nomad.config.admin.color_title') }}
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    {{ trans('theme::nomad.config.admin.color_info') }}
                </div>

                <div class="mb-3">
                    <label class="form-label" for="colorInput">{{ trans('messages.fields.color') }}</label>
                    <input type="color" class="form-control form-control-color color-picker @error('color') is-invalid @enderror" 
                           id="colorInput" name="color" 
                           value="{{ old('color', theme_config('color', '#ffc107')) }}" required>

                    @error('color')
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
                    <i class="bi bi-image me-2"></i>
                    {{ trans('theme::nomad.config.admin.logo_size_title') }}
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    {{ trans('theme::nomad.config.admin.logo_size_info') }}
                </div>

                <div class="mb-3">
                    <label class="form-label" for="logoSizeInput">{{ trans('theme::nomad.config.admin.logo_size_label') }}</label>
                    <div class="d-flex align-items-center gap-3">
                        <input type="range" class="form-range flex-grow-1 @error('logo_size') is-invalid @enderror" 
                               id="logoSizeInput" name="logo_size" 
                               min="50" max="800" step="10"
                               value="{{ old('logo_size', theme_config('logo_size', 200)) }}">
                        <span class="badge bg-primary" id="logoSizeValue">{{ old('logo_size', theme_config('logo_size', 200)) }}px</span>
                    </div>
                    <small class="form-text text-muted">{{ trans('theme::nomad.config.admin.logo_size_help') }}</small>
                    
                    @error('logo_size')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>