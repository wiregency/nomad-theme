<div class="tab-pane" id="tab-footer">
    <div class="section-header">
        <h3 class="section-title">
            <i class="bi bi-layout-text-window-reverse me-2"></i>
            {{ trans('theme::nomad.config.admin.footer_title_section') }}
        </h3>
        <p class="section-description text-muted mb-0">
            {{ trans('theme::nomad.config.admin.footer_description_section') }}
        </p>
    </div>

    <div class="config-card">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-type me-2"></i>
                    {{ trans('theme::nomad.config.admin.footer_order_title') }}
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label" for="footerAboutTitleInput">{{ trans('theme::nomad.config.admin.footer_about_title') }}</label>
                        <input type="text" class="form-control @error('footer_about_title') is-invalid @enderror" 
                               id="footerAboutTitleInput" name="footer_about_title"
                               placeholder="{{ trans('theme::nomad.config.admin.footer_about_title_placeholder') }}"
                               value="{{ old('footer_about_title', theme_config('footer_about_title')) }}">
                        @error('footer_about_title')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="footerLinksTitleInput">{{ trans('theme::nomad.config.admin.footer_links_title_section') }}</label>
                        <input type="text" class="form-control @error('footer_links_title') is-invalid @enderror" 
                               id="footerLinksTitleInput" name="footer_links_title"
                               placeholder="{{ trans('theme::nomad.config.admin.footer_links_title_placeholder') }}"
                               value="{{ old('footer_links_title', theme_config('footer_links_title')) }}">
                        @error('footer_links_title')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="footerSocialTitleInput">{{ trans('theme::nomad.config.admin.footer_social_title_section') }}</label>
                        <input type="text" class="form-control @error('footer_social_title') is-invalid @enderror" 
                               id="footerSocialTitleInput" name="footer_social_title"
                               placeholder="{{ trans('theme::nomad.config.admin.footer_social_title_placeholder') }}"
                               value="{{ old('footer_social_title', theme_config('footer_social_title')) }}">
                        @error('footer_social_title')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="config-card">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-arrows-move me-2"></i>
                    {{ trans('theme::nomad.config.admin.footer_order_title') }}
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info mb-4">
                    <i class="bi bi-info-circle me-2"></i>
                    {{ trans('theme::nomad.config.admin.footer_order_description') }}
                </div>

                <div id="footer-order-list" class="sortable-list">
                    @php
                        $defaultOrder = ['about', 'links', 'social'];
                        $currentOrder = theme_config('footer_order') ?? $defaultOrder;
                        
                        $elements = [
                            'about' => [
                                'name' => trans('theme::nomad.config.admin.footer_order_about'),
                                'icon' => 'bi bi-info-circle-fill',
                                'color' => 'primary'
                            ],
                            'links' => [
                                'name' => trans('theme::nomad.config.admin.footer_order_links'),
                                'icon' => 'bi bi-link-45deg',
                                'color' => 'success'
                            ],
                            'social' => [
                                'name' => trans('theme::nomad.config.admin.footer_order_social'),
                                'icon' => 'bi bi-share-fill',
                                'color' => 'info'
                            ]
                        ];
                    @endphp

                    @foreach($currentOrder as $key)
                        @if(isset($elements[$key]))
                            <div class="sortable-item mb-3 p-3 border rounded bg-light d-flex align-items-center" data-element="{{ $key }}">
                                <div class="sortable-handle me-3 text-muted" style="cursor: grab;">
                                    <i class="bi bi-grip-vertical fs-5"></i>
                                </div>
                                <div class="flex-fill d-flex align-items-center">
                                    <div class="badge bg-{{ $elements[$key]['color'] }} me-3">
                                        <i class="{{ $elements[$key]['icon'] }} me-1"></i>
                                        {{ $elements[$key]['name'] }}
                                    </div>
                                    <span class="text-muted small">{{ trans('theme::nomad.config.admin.footer_drag_help') }}</span>
                                </div>
                                <input type="hidden" name="footer_order[]" value="{{ $key }}">
                            </div>
                        @endif
                    @endforeach

                    @foreach($defaultOrder as $key)
                        @if(!in_array($key, $currentOrder) && isset($elements[$key]))
                            <div class="sortable-item mb-3 p-3 border rounded bg-light d-flex align-items-center" data-element="{{ $key }}">
                                <div class="sortable-handle me-3 text-muted" style="cursor: grab;">
                                    <i class="bi bi-grip-vertical fs-5"></i>
                                </div>
                                <div class="flex-fill d-flex align-items-center">
                                    <div class="badge bg-{{ $elements[$key]['color'] }} me-3">
                                        <i class="{{ $elements[$key]['icon'] }} me-1"></i>
                                        {{ $elements[$key]['name'] }}
                                    </div>
                                    <span class="text-muted small">{{ trans('theme::nomad.config.admin.footer_drag_help') }}</span>
                                </div>
                                <input type="hidden" name="footer_order[]" value="{{ $key }}">
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="config-card">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-card-text me-2"></i>
                    {{ trans('theme::nomad.config.admin.footer_desc_title') }}
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label" for="footerDescriptionInput">{{ trans('theme::nomad.config.footer_description') }}</label>
                    <textarea class="form-control @error('footer_description') is-invalid @enderror" 
                              id="footerDescriptionInput" name="footer_description" rows="3"
                              placeholder="{{ trans('theme::nomad.config.admin.footer_description_placeholder') }}">{{ old('footer_description', theme_config('footer_description')) }}</textarea>

                    @error('footer_description')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="config-card">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-link-45deg me-2"></i>
                        {{ trans('theme::nomad.config.admin.footer_links_title') }}
                    </h5>
                    <button type="button" id="addLinkButton" class="btn btn-sm btn-success">
                        <i class="bi bi-plus-lg me-1"></i> {{ trans('theme::nomad.config.admin.add_link') }}
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="alert alert-info mb-4">
                    <i class="bi bi-info-circle me-2"></i>
                    {{ trans('theme::nomad.config.admin.footer_links_info') }}
                </div>

                <span data-lang="name-label" class="d-none">{{ trans('theme::nomad.config.admin.name_label') }}</span>
                <span data-lang="url-label" class="d-none">{{ trans('theme::nomad.config.admin.url_label') }}</span>
                <span data-lang="name-placeholder" class="d-none">{{ trans('messages.fields.name') }}</span>
                <span data-lang="link-placeholder" class="d-none">{{ trans('messages.fields.link') }}</span>
                <span data-lang="new-tab-label" class="d-none">{{ trans('theme::nomad.config.admin.new_tab_label') }}</span>
                <span data-lang="new-tab-help" class="d-none">{{ trans('theme::nomad.config.admin.new_tab_help') }}</span>

                <div id="links">
                    @forelse(theme_config('footer_links') ?? [] as $index => $link)
                        <div class="link-item mb-3 p-3 border rounded bg-light">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">{{ trans('theme::nomad.config.admin.name_label') }}</label>
                                    <input type="text" class="form-control" 
                                           name="footer_links[{{ $index }}][name]" 
                                           placeholder="{{ trans('messages.fields.name') }}" 
                                           value="{{ $link['name'] }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">{{ trans('theme::nomad.config.admin.url_label') }}</label>
                                    <input type="url" class="form-control" 
                                           name="footer_links[{{ $index }}][value]" 
                                           placeholder="{{ trans('messages.fields.link') }}" 
                                           value="{{ $link['value'] }}">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">{{ trans('theme::nomad.config.admin.new_tab_label') }}</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" 
                                               name="footer_links[{{ $index }}][new_tab]" 
                                               value="1" 
                                               id="footer_link_new_tab_{{ $index }}"
                                               {{ isset($link['new_tab']) && $link['new_tab'] ? 'checked' : '' }}>
                                        <label class="form-check-label small text-muted" for="footer_link_new_tab_{{ $index }}">
                                            {{ trans('theme::nomad.config.admin.new_tab_help') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-1 d-flex align-items-end">
                                    <button class="btn btn-outline-danger btn-sm link-remove" type="button" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="bi bi-link-45deg text-muted fs-1 d-block mb-3"></i>
                            <p class="text-muted mb-0">{{ trans('theme::nomad.config.admin.no_links') }}</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="config-card">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-shield-check me-2"></i>
                        {{ trans('theme::nomad.config.admin.footer_legal_title') }}
                    </h5>
                    <button type="button" id="addLegalLinkButton" class="btn btn-sm btn-success">
                        <i class="bi bi-plus-lg me-1"></i> {{ trans('theme::nomad.config.admin.add_legal_link') }}
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="alert alert-warning mb-4">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ trans('theme::nomad.config.admin.footer_legal_info') }}
                </div>

                <div id="legal-links">
                    @forelse(theme_config('legal_links') ?? [] as $index => $link)
                        <div class="link-item mb-3 p-3 border rounded bg-light">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">{{ trans('theme::nomad.config.admin.name_label') }}</label>
                                    <input type="text" class="form-control" 
                                           name="legal_links[{{ $index }}][name]" 
                                           placeholder="{{ trans('messages.fields.name') }}" 
                                           value="{{ $link['name'] }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">{{ trans('theme::nomad.config.admin.url_label') }}</label>
                                    <input type="url" class="form-control" 
                                           name="legal_links[{{ $index }}][value]" 
                                           placeholder="{{ trans('messages.fields.link') }}" 
                                           value="{{ $link['value'] }}">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">{{ trans('theme::nomad.config.admin.new_tab_label') }}</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" 
                                               name="legal_links[{{ $index }}][new_tab]" 
                                               value="1" 
                                               id="legal_link_new_tab_{{ $index }}"
                                               {{ isset($link['new_tab']) && $link['new_tab'] ? 'checked' : '' }}>
                                        <label class="form-check-label small text-muted" for="legal_link_new_tab_{{ $index }}">
                                            {{ trans('theme::nomad.config.admin.new_tab_help') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-1 d-flex align-items-end">
                                    <button class="btn btn-outline-danger btn-sm legal-link-remove" type="button" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="bi bi-shield-check text-muted fs-1 d-block mb-3"></i>
                            <p class="text-muted mb-0">{{ trans('theme::nomad.config.admin.no_legal_links') }}</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>