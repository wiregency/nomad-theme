<div class="tab-pane" id="tab-stats">
    <div class="section-header">
        <h3 class="section-title">
            <i class="bi bi-graph-up me-2"></i>
            {{ trans('theme::nomad.config.admin.stats_title_section') }}
        </h3>
        <p class="section-description text-muted mb-0">
            {{ trans('theme::nomad.config.admin.stats_description_section') }}
        </p>
    </div>

    <div class="config-card">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-bar-chart me-2"></i>
                    {{ trans('theme::nomad.config.admin.stats_config_title') }}
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="border rounded p-3 mb-3">
                            <h6 class="text-primary mb-3">
                                <i class="bi bi-wifi me-1"></i> {{ trans('theme::nomad.config.admin.stats_1_title') }}
                            </h6>
                            
                            <div class="mb-3">
                                <label class="form-label" for="statsIcon1Input">{{ trans('theme::nomad.config.stats_icon_1') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-people-fill"></i></span>
                                    <input type="text" class="form-control @error('stats_icon_1') is-invalid @enderror" 
                                           id="statsIcon1Input" name="stats_icon_1" 
                                           value="{{ old('stats_icon_1', theme_config('stats_icon_1', 'bi bi-people-fill')) }}"
                                           placeholder="{{ trans('theme::nomad.config.admin.stats_icon_1_placeholder') }}">
                                </div>
                                @error('stats_icon_1')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label" for="onlinePlayersLabelInput">{{ trans('theme::nomad.config.online_players_label') }}</label>
                                <input type="text" class="form-control @error('online_players_label') is-invalid @enderror" 
                                       id="onlinePlayersLabelInput" name="online_players_label" 
                                       value="{{ old('online_players_label', theme_config('online_players_label', 'Joueurs en ligne')) }}"
                                       placeholder="{{ trans('theme::nomad.config.admin.online_players_label_placeholder') }}">
                                @error('online_players_label')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="border rounded p-3 mb-3">
                            <h6 class="text-primary mb-3">
                                <i class="bi bi-person me-1"></i> {{ trans('theme::nomad.config.admin.stats_2_title') }}
                            </h6>
                            
                            <div class="mb-3">
                                <label class="form-label" for="statsIcon2Input">{{ trans('theme::nomad.config.stats_icon_2') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                    <input type="text" class="form-control @error('stats_icon_2') is-invalid @enderror" 
                                           id="statsIcon2Input" name="stats_icon_2" 
                                           value="{{ old('stats_icon_2', theme_config('stats_icon_2', 'bi bi-person-fill')) }}"
                                           placeholder="{{ trans('theme::nomad.config.admin.stats_icon_2_placeholder') }}">
                                </div>
                                @error('stats_icon_2')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label" for="uniquePlayersInput">{{ trans('theme::nomad.config.unique_players') }}</label>
                                <input type="number" class="form-control @error('unique_players') is-invalid @enderror" 
                                       id="uniquePlayersInput" name="unique_players" 
                                       value="{{ old('unique_players', theme_config('unique_players', '150')) }}"
                                       placeholder="{{ trans('theme::nomad.config.admin.unique_players_placeholder') }}">
                                @error('unique_players')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label" for="uniquePlayersLabelInput">{{ trans('theme::nomad.config.unique_players_label') }}</label>
                                <input type="text" class="form-control @error('unique_players_label') is-invalid @enderror" 
                                       id="uniquePlayersLabelInput" name="unique_players_label" 
                                       value="{{ old('unique_players_label', theme_config('unique_players_label', 'Joueurs uniques')) }}"
                                       placeholder="{{ trans('theme::nomad.config.admin.unique_players_label_placeholder') }}">
                                @error('unique_players_label')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="border rounded p-3 mb-3">
                            <h6 class="text-primary mb-3">
                                <i class="bi bi-trophy me-1"></i> {{ trans('theme::nomad.config.admin.stats_3_title') }}
                            </h6>
                            
                            <div class="mb-3">
                                <label class="form-label" for="statsIcon3Input">{{ trans('theme::nomad.config.stats_icon_3') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-trophy-fill"></i></span>
                                    <input type="text" class="form-control @error('stats_icon_3') is-invalid @enderror" 
                                           id="statsIcon3Input" name="stats_icon_3" 
                                           value="{{ old('stats_icon_3', theme_config('stats_icon_3', 'bi bi-trophy-fill')) }}"
                                           placeholder="{{ trans('theme::nomad.config.admin.stats_icon_3_placeholder') }}">
                                </div>
                                @error('stats_icon_3')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label" for="recordPlayersInput">{{ trans('theme::nomad.config.record_players') }}</label>
                                <input type="number" class="form-control @error('record_players') is-invalid @enderror" 
                                       id="recordPlayersInput" name="record_players" 
                                       value="{{ old('record_players', theme_config('record_players', '276')) }}"
                                       placeholder="{{ trans('theme::nomad.config.admin.record_players_placeholder') }}">
                                @error('record_players')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label" for="recordPlayersLabelInput">{{ trans('theme::nomad.config.record_players_label') }}</label>
                                <input type="text" class="form-control @error('record_players_label') is-invalid @enderror" 
                                       id="recordPlayersLabelInput" name="record_players_label" 
                                       value="{{ old('record_players_label', theme_config('record_players_label', 'Record de joueurs')) }}"
                                       placeholder="{{ trans('theme::nomad.config.admin.record_players_label_placeholder') }}">
                                @error('record_players_label')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>{{ trans('theme::nomad.config.admin.tip') }}:</strong> {{ trans('theme::nomad.config.admin.stats_icons_help') }} 
                    <a href="https://icons.getbootstrap.com/" target="_blank" rel="noopener">{{ trans('theme::nomad.config.admin.stats_icons_link') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>